<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralConfig;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GeneralConfigController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', GeneralConfig::TYPE_PRODUCT_TYPE);
        
        $configs = GeneralConfig::ofType($type)
            ->ordered()
            ->paginate(20);
        
        $configTypes = GeneralConfig::getTypes();
        
        return view('admin.configs.index', compact('configs', 'type', 'configTypes'));
    }

    public function create(Request $request)
    {
        $type = $request->get('type', GeneralConfig::TYPE_PRODUCT_TYPE);
        $configTypes = GeneralConfig::getTypes();
        
        return view('admin.configs.create', compact('type', 'configTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', 'string', Rule::in(array_keys(GeneralConfig::getTypes()))],
            'key' => 'required|string|max:50|unique:general_configs,key|regex:/^[a-z0-9_]+$/',
            'label' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ], [
            'key.regex' => 'Key hanya boleh berisi huruf kecil, angka, dan underscore.',
            'key.unique' => 'Key sudah digunakan.',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        GeneralConfig::create($validated);

        return redirect()
            ->route('admin.configs.index', ['type' => $validated['type']])
            ->with('success', 'Konfigurasi berhasil ditambahkan.');
    }

    public function edit(GeneralConfig $config)
    {
        $configTypes = GeneralConfig::getTypes();
        
        return view('admin.configs.edit', compact('config', 'configTypes'));
    }

    public function update(Request $request, GeneralConfig $config)
    {
        $validated = $request->validate([
            'type' => ['required', 'string', Rule::in(array_keys(GeneralConfig::getTypes()))],
            'key' => ['required', 'string', 'max:50', 'regex:/^[a-z0-9_]+$/', Rule::unique('general_configs', 'key')->ignore($config->id)],
            'label' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ], [
            'key.regex' => 'Key hanya boleh berisi huruf kecil, angka, dan underscore.',
            'key.unique' => 'Key sudah digunakan.',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $config->update($validated);

        return redirect()
            ->route('admin.configs.index', ['type' => $validated['type']])
            ->with('success', 'Konfigurasi berhasil diperbarui.');
    }

    public function destroy(GeneralConfig $config)
    {
        $type = $config->type;
        $config->delete();

        return redirect()
            ->route('admin.configs.index', ['type' => $type])
            ->with('success', 'Konfigurasi berhasil dihapus.');
    }
}
