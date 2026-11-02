<nav class="sticky top-0 z-50 backdrop-blur-md bg-slate-950/80 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        <!-- Brand / Logo -->
        <a href="index.php" class="flex items-center gap-3 text-xl font-extrabold bg-gradient-to-r from-sky-400 to-indigo-400 bg-clip-text text-transparent hover:opacity-80 transition-opacity">
            <i data-lucide="layers" class="w-6 h-6 text-sky-400"></i>
            <span>PHP MVC</span>
            <span class="text-xs font-semibold bg-indigo-500/30 text-indigo-300 border border-indigo-500/40 rounded-full px-2 py-0.5">Week 6</span>
        </a>

        <!-- Navigation Links -->
        <nav class="flex items-center gap-1">
            <a href="index.php?page=employee"
               class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200
                      <?= (($activeTab ?? '') === 'employee') ? 'bg-sky-500/20 text-sky-300 border border-sky-500/30' : 'text-slate-400 hover:text-slate-100 hover:bg-white/5' ?>">
                <i data-lucide="users" class="w-4 h-4"></i>
                <span>Employee</span>
            </a>
            <a href="index.php?page=office"
               class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200
                      <?= (($activeTab ?? '') === 'office') ? 'bg-sky-500/20 text-sky-300 border border-sky-500/30' : 'text-slate-400 hover:text-slate-100 hover:bg-white/5' ?>">
                <i data-lucide="building-2" class="w-4 h-4"></i>
                <span>Office</span>
            </a>
            <a href="index.php?page=office-employees"
               class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200
                      <?= (($activeTab ?? '') === 'office-employees') ? 'bg-sky-500/20 text-sky-300 border border-sky-500/30' : 'text-slate-400 hover:text-slate-100 hover:bg-white/5' ?>">
                <i data-lucide="network" class="w-4 h-4"></i>
                <span>Office-Employees</span>
            </a>
        </nav>
    </div>
</nav>
