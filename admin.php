<?php
$file = 'data.json';
$data = json_decode(file_get_contents($file), true);

// Handle Form Submit (Simpan / Tambah / Hapus)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'save') {
            $newItems = [];
            foreach ($_POST['names'] as $i => $name) {
                if (trim($name) !== '') {
                    $newItems[] = [
                        'name' => trim($name),
                        'percentage' => (float)$_POST['percentages'][$i],
                        'color' => $_POST['colors'][$i]
                    ];
                }
            }
            $data['items'] = $newItems;
            file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
            $success = "Pengaturan berhasil disimpan!";
        }
    }
}

$totalPercent = array_sum(array_column($data['items'], 'percentage'));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Namz Spin Wheel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #0f172a; color: #fff; font-family: 'Inter', sans-serif; }
        .glass { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body class="p-4 md:p-8 max-w-3xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-xl font-bold text-cyan-400"><i class="fa-solid fa-gear"></i> Admin Panel Spin Wheel</h1>
            <p class="text-xs text-slate-400">Atur nama peserta dan persentase kemenangan.</p>
        </div>
        <a href="index.php" target="_blank" class="px-4 py-2 bg-cyan-600 hover:bg-cyan-500 text-xs font-semibold rounded-lg transition"><i class="fa-solid fa-eye"></i> Lihat Web</a>
    </div>

    <?php if (isset($success)): ?>
        <div class="mb-4 p-3 bg-emerald-500/20 border border-emerald-500 text-emerald-300 text-xs rounded-lg">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <div class="mb-4 p-3 glass rounded-xl flex justify-between items-center text-xs">
        <span>Total Persentase Saat Ini: <strong><?php echo $totalPercent; ?>%</strong></span>
        <?php if ($totalPercent != 100): ?>
            <span class="text-amber-400"><i class="fa-solid fa-triangle-exclamation"></i> Disarankan total 100%</span>
        <?php else: ?>
            <span class="text-emerald-400"><i class="fa-solid fa-circle-check"></i> Sempurna (100%)</span>
        <?php endif; ?>
    </div>

    <form method="POST" class="space-y-4">
        <input type="hidden" name="action" value="save">
        
        <div id="itemContainer" class="space-y-3">
            <?php foreach ($data['items'] as $i => $item): ?>
                <div class="flex items-center gap-2 glass p-3 rounded-xl item-row">
                    <input type="text" name="names[]" value="<?php echo htmlspecialchars($item['name']); ?>" placeholder="Nama Peserta" class="flex-1 bg-slate-900 border border-slate-700 px-3 py-2 rounded-lg text-xs focus:outline-none focus:border-cyan-500" required>
                    <div class="flex items-center gap-1 w-28">
                        <input type="number" step="any" name="percentages[]" value="<?php echo $item['percentage']; ?>" placeholder="%" class="w-full bg-slate-900 border border-slate-700 px-2 py-2 rounded-lg text-xs text-center focus:outline-none focus:border-cyan-500" required>
                        <span class="text-xs text-slate-400">%</span>
                    </div>
                    <input type="color" name="colors[]" value="<?php echo $item['color'] ?? '#3b82f6'; ?>" class="w-9 h-9 bg-transparent cursor-pointer rounded-lg border border-slate-700">
                    <button type="button" onclick="removeItem(this)" class="p-2 text-rose-400 hover:bg-rose-500/20 rounded-lg transition"><i class="fa-solid fa-trash"></i></button>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="flex gap-2 pt-2">
            <button type="button" onclick="addItem()" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-xs font-semibold rounded-xl transition border border-slate-700"><i class="fa-solid fa-plus"></i> Tambah Peserta</button>
            <button type="submit" class="flex-1 py-2.5 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-xs font-bold rounded-xl shadow-lg transition"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
        </div>
    </form>

    <script>
        function addItem() {
            const container = document.getElementById('itemContainer');
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2 glass p-3 rounded-xl item-row';
            div.innerHTML = `
                <input type="text" name="names[]" placeholder="Nama Peserta" class="flex-1 bg-slate-900 border border-slate-700 px-3 py-2 rounded-lg text-xs focus:outline-none focus:border-cyan-500" required>
                <div class="flex items-center gap-1 w-28">
                    <input type="number" step="any" name="percentages[]" value="10" placeholder="%" class="w-full bg-slate-900 border border-slate-700 px-2 py-2 rounded-lg text-xs text-center focus:outline-none focus:border-cyan-500" required>
                    <span class="text-xs text-slate-400">%</span>
                </div>
                <input type="color" name="colors[]" value="#3b82f6" class="w-9 h-9 bg-transparent cursor-pointer rounded-lg border border-slate-700">
                <button type="button" onclick="removeItem(this)" class="p-2 text-rose-400 hover:bg-rose-500/20 rounded-lg transition"><i class="fa-solid fa-trash"></i></button>
            `;
            container.appendChild(div);
        }

        function removeItem(btn) {
            const rows = document.querySelectorAll('.item-row');
            if (rows.length > 1) {
                btn.closest('.item-row').remove();
            } else {
                alert('Minimal harus ada 1 peserta!');
            }
        }
    </script>
</body>
</html>
