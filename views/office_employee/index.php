<?php require __DIR__ . '/../layouts/app.php'; ?>

<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-white">Office Employees</h1>
    <p class="text-slate-400 mt-1">Penugasan Karyawan ke Kantor Cabang (CHALLENGE: Office-Employee Relationship)</p>
</div>

<!-- Flash Messages -->
<?php if (isset($_GET['status']) && $_GET['status'] === 'added'): ?>
    <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm">
        <i data-lucide="check-circle-2" class="w-5 h-5 flex-shrink-0"></i>
        <span>Relasi Employee-Office berhasil disimpan!</span>
    </div>
<?php endif; ?>

<?php if (isset($_GET['status']) && $_GET['status'] === 'deleted'): ?>
    <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
        <i data-lucide="trash-2" class="w-5 h-5 flex-shrink-0"></i>
        <span>Relasi Employee-Office berhasil dihapus!</span>
    </div>
<?php endif; ?>

<?php if (!empty($flashMessage ?? null)): ?>
    <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
        <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
        <span><?= htmlspecialchars($flashMessage) ?></span>
    </div>
<?php endif; ?>

<!-- Main Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Form Assign Employee to Office -->
    <div class="rounded-2xl bg-slate-800/50 border border-white/10 backdrop-blur-sm p-6">
        <div class="flex items-center gap-3 mb-5">
            <div class="p-2 rounded-lg bg-sky-500/10">
                <i data-lucide="user-check" class="w-5 h-5 text-sky-400"></i>
            </div>
            <h2 class="text-lg font-semibold text-white">Assign Employee to Office</h2>
        </div>

        <form action="index.php?page=office-employees&action=store" method="POST" class="space-y-4">
            <div>
                <label for="employee_id" class="block text-sm font-medium text-slate-300 mb-1.5">Employee</label>
                <select id="employee_id" name="employee_id"
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-900/60 border border-white/10 text-white
                               focus:outline-none focus:ring-2 focus:ring-sky-500/40 focus:border-sky-500/50 transition-all text-sm" required>
                    <option value="" disabled selected class="text-slate-500">-- Pilih Employee --</option>
                    <?php foreach (($employees ?? []) as $emp): ?>
                        <option value="<?= htmlspecialchars($emp['id']) ?>" class="bg-slate-800 text-white">
                            <?= htmlspecialchars($emp['nama']) ?> (<?= htmlspecialchars($emp['jabatan']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="office_id" class="block text-sm font-medium text-slate-300 mb-1.5">Office</label>
                <select id="office_id" name="office_id"
                        class="w-full px-4 py-2.5 rounded-xl bg-slate-900/60 border border-white/10 text-white
                               focus:outline-none focus:ring-2 focus:ring-sky-500/40 focus:border-sky-500/50 transition-all text-sm" required>
                    <option value="" disabled selected class="text-slate-500">-- Pilih Office --</option>
                    <?php foreach (($offices ?? []) as $off): ?>
                        <option value="<?= htmlspecialchars($off['id']) ?>" class="bg-slate-800 text-white">
                            <?= htmlspecialchars($off['nama_kantor']) ?> (<?= htmlspecialchars($off['kota']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl
                           bg-sky-500 hover:bg-sky-400 text-white font-semibold text-sm transition-all duration-200 mt-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                <span>SAVE</span>
            </button>
        </form>
    </div>

    <!-- Tabel Relasi Office Employees -->
    <div class="rounded-2xl bg-slate-800/50 border border-white/10 backdrop-blur-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-indigo-500/10">
                    <i data-lucide="link" class="w-5 h-5 text-indigo-400"></i>
                </div>
                <h2 class="text-lg font-semibold text-white">Data Office Employees</h2>
            </div>
            <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                <?= count($officeEmployees ?? []) ?> Total
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/10">
                        <th class="text-left text-slate-400 font-medium pb-3 w-8">No</th>
                        <th class="text-left text-slate-400 font-medium pb-3">Employee</th>
                        <th class="text-left text-slate-400 font-medium pb-3">Office</th>
                        <th class="text-right text-slate-400 font-medium pb-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <?php if (empty($officeEmployees)): ?>
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-500">
                                Belum ada relasi karyawan dan kantor.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($officeEmployees as $index => $rel): ?>
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="py-3 font-bold text-slate-400"><?= $index + 1 ?></td>
                                <td class="py-3">
                                    <div class="font-semibold text-white"><?= htmlspecialchars($rel['employee_name']) ?></div>
                                    <div class="text-xs text-slate-500 mt-0.5"><?= htmlspecialchars($rel['employee_jabatan']) ?></div>
                                </td>
                                <td class="py-3">
                                    <span class="px-2 py-0.5 rounded-full bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 text-xs font-medium">
                                        <?= htmlspecialchars($rel['office_name']) ?>
                                    </span>
                                    <div class="text-xs text-slate-500 mt-0.5"><?= htmlspecialchars($rel['office_city']) ?></div>
                                </td>
                                <td class="py-3 text-right">
                                    <a href="index.php?page=office-employees&action=delete&id=<?= urlencode($rel['id']) ?>"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/15 text-red-400 border border-red-500/25
                                              hover:bg-red-500/25 transition-all text-xs font-medium"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus relasi ini?')">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        <span>Delete</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require __DIR__ . '/../layouts/app_end.php'; ?>
