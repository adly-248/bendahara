<x-app-layout>
    <x-slot name="header">
        <style>
            .dashboard-header {
                background: linear-gradient(135deg, rgba(139, 0, 0, 0.1) 0%, rgba(220, 20, 60, 0.05) 100%);
                backdrop-filter: blur(20px);
                border-radius: 20px;
                border: 1px solid rgba(220, 20, 60, 0.15);
                padding: 24px 32px;
                box-shadow: 0 8px 32px rgba(139, 0, 0, 0.1);
            }

            .dashboard-title {
                font-size: 28px;
                font-weight: 800;
                background: linear-gradient(135deg, #8B0000 0%, #DC143C 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                letter-spacing: -0.5px;
                margin: 0;
                text-shadow: 0 2px 4px rgba(139, 0, 0, 0.1);
            }

            /* Global Dashboard Styles */
            .dashboard-container {
                background: transparent;
                min-height: calc(100vh - 200px);
                position: relative;
            }

            .welcome-section {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 20px;
                box-shadow: 0 8px 32px rgba(139, 0, 0, 0.1);
                border: 1px solid rgba(220, 20, 60, 0.15);
                padding: 32px;
                margin-bottom: 32px;
                position: relative;
                overflow: hidden;
            }

            .welcome-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(135deg, #8B0000 0%, #DC143C 50%, #B22222 100%);
            }

            .welcome-title {
                font-size: 24px;
                font-weight: 700;
                color: #8B0000;
                margin-bottom: 12px;
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .welcome-description {
                color: #6B7280;
                font-size: 16px;
                line-height: 1.6;
            }

            /* Stats Cards */
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 24px;
                margin-bottom: 32px;
            }

            .stat-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 20px;
                box-shadow: 0 8px 32px rgba(139, 0, 0, 0.1);
                border: 1px solid rgba(220, 20, 60, 0.15);
                padding: 28px;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .stat-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 40px rgba(139, 0, 0, 0.15);
            }

            .stat-card.income {
                border-left: 4px solid #10B981;
            }

            .stat-card.expense {
                border-left: 4px solid #EF4444;
            }

            .stat-card.balance {
                border-left: 4px solid #3B82F6;
            }

            .stat-card::before {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                width: 100px;
                height: 100px;
                background: radial-gradient(circle, rgba(220, 20, 60, 0.05) 0%, transparent 70%);
                border-radius: 50%;
                transform: translate(30%, -30%);
            }

            .stat-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 16px;
            }

            .stat-label {
                font-size: 14px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 8px;
            }

            .stat-label.income { color: #10B981; }
            .stat-label.expense { color: #EF4444; }
            .stat-label.balance { color: #3B82F6; }

            .stat-value {
                font-size: 32px;
                font-weight: 800;
                color: #1F2937;
                margin-bottom: 8px;
            }

            .stat-icon {
                width: 64px;
                height: 64px;
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 28px;
                opacity: 0.7;
            }

            .stat-icon.income {
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.2));
                color: #10B981;
            }

            .stat-icon.expense {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.2));
                color: #EF4444;
            }

            .stat-icon.balance {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.2));
                color: #3B82F6;
            }

            /* Charts Section */
            .charts-grid {
                display: grid;
                grid-template-columns: 2fr 1fr;
                gap: 24px;
                margin-bottom: 32px;
            }

            .chart-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 20px;
                box-shadow: 0 8px 32px rgba(139, 0, 0, 0.1);
                border: 1px solid rgba(220, 20, 60, 0.15);
                padding: 32px;
                transition: all 0.3s ease;
            }

            .chart-card:hover {
                box-shadow: 0 12px 40px rgba(139, 0, 0, 0.15);
            }

            .chart-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 24px;
                padding-bottom: 16px;
                border-bottom: 1px solid rgba(220, 20, 60, 0.1);
            }

            .chart-title {
                font-size: 20px;
                font-weight: 700;
                color: #8B0000;
                margin: 0;
            }

            .chart-body {
                position: relative;
                height: 350px;
            }

            .chart-body canvas {
                max-height: 100% !important;
            }

            /* Responsive Design */
            @media (max-width: 1200px) {
                .charts-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 768px) {
                .stats-grid {
                    grid-template-columns: 1fr;
                }

                .dashboard-title {
                    font-size: 20px;
                }

                .welcome-title {
                    font-size: 20px;
                }

                .stat-value {
                    font-size: 24px;
                }

                .chart-card {
                    padding: 20px;
                }
            }

            /* Animation */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fadeInUp 0.6s ease-out;
            }

            .animate-delay-1 { animation-delay: 0.1s; }
            .animate-delay-2 { animation-delay: 0.2s; }
            .animate-delay-3 { animation-delay: 0.3s; }

            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }

            ::-webkit-scrollbar-track {
                background: rgba(0, 0, 0, 0.1);
            }

            ::-webkit-scrollbar-thumb {
                background: linear-gradient(135deg, #8B0000, #DC143C);
                border-radius: 4px;
            }
        </style>

    </x-slot>

    <div class="dashboard-container animate-fade-in">
        <!-- Welcome Section -->
        <div class="welcome-section animate-delay-1">
            <h3 class="welcome-title">
                👋 Selamat Datang, Bendahara Sekolah!
            </h3>
            <p class="welcome-description">
                Terima kasih telah mengelola administrasi keuangan sekolah dengan teliti.
                Silakan pantau pembayaran, catatan kas, dan laporan keuangan di menu yang tersedia.
            </p>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <!-- Income Card -->
            <div class="stat-card income animate-fade-in animate-delay-1">
                <div class="stat-header">
                    <div>
                        <div class="stat-label income">Pemasukkan (Per Bulan)</div>
                        <div class="stat-value">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-icon income">
                        📈
                    </div>
                </div>
            </div>

            <!-- Expense Card -->
            <div class="stat-card expense animate-fade-in animate-delay-2">
                <div class="stat-header">
                    <div>
                        <div class="stat-label expense">Pengeluaran (Per Bulan)</div>
                        <div class="stat-value">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-icon expense">
                        📉
                    </div>
                </div>
            </div>

            <!-- Balance Card -->
            <div class="stat-card balance animate-fade-in animate-delay-3">
                <div class="stat-header">
                    <div>
                        <div class="stat-label balance">Saldo Akhir</div>
                        <div class="stat-value">Rp{{ number_format($saldo, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-icon balance">
                        💰
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-grid">
            <!-- Line Chart -->
            <div class="chart-card animate-fade-in animate-delay-1">
                <div class="chart-header">
                    <h6 class="chart-title">📊 Grafik Keuangan Bulanan</h6>
                </div>
                <div class="chart-body">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="chart-card animate-fade-in animate-delay-2">
                <div class="chart-header">
                    <h6 class="chart-title">🥧 Distribusi Keuangan</h6>
                </div>
                <div class="chart-body">
                    <canvas id="myPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

    <!-- Chart.js Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
    // Line Chart
    var ctx = document.getElementById("myAreaChart").getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
            datasets: [{
                label: "Pemasukkan",
                tension: 0.4,
                backgroundColor: "rgba(16, 185, 129, 0.1)",
                borderColor: "#10B981",
                borderWidth: 3,
                pointBackgroundColor: "#10B981",
                pointBorderColor: "#ffffff",
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                data: [
                    @for ($i = 1; $i <= 12; $i++)
                        {{ $monthlyIncome[$i] ?? 0 }}@if($i<12),@endif
                    @endfor
                ],
            }, {
                label: "Pengeluaran",
                tension: 0.4,
                backgroundColor: "rgba(239, 68, 68, 0.1)",
                borderColor: "#EF4444",
                borderWidth: 3,
                pointBackgroundColor: "#EF4444",
                pointBorderColor: "#ffffff",
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                data: [
                    @for ($i = 1; $i <= 12; $i++)
                        {{ $monthlyExpense[$i] ?? 0 }}@if($i<12),@endif
                    @endfor
                ],
            }, {
                label: "Saldo (Bulanan)",
                tension: 0.4,
                backgroundColor: "rgba(59, 130, 246, 0.1)",
                borderColor: "#3B82F6",
                borderWidth: 3,
                pointBackgroundColor: "#3B82F6",
                pointBorderColor: "#ffffff",
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                data: [
                    @for ($i = 1; $i <= 12; $i++)
                        {{ $monthlySaldo[$i] ?? 0 }}@if($i<12),@endif
                    @endfor
                ],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: { size: 14, weight: 600 }
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(220, 20, 60, 0.1)' },
                    ticks: { font: { size: 12, weight: 500 } }
                },
                y: {
                    grid: { color: 'rgba(220, 20, 60, 0.1)' },
                    ticks: {
                        font: { size: 12, weight: 500 },
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            interaction: { intersect: false, mode: 'index' }
        }
    });

    // Pie Chart (tetap pakai total bulan berjalan)
    var ctxPie = document.getElementById("myPieChart").getContext('2d');
    var myPieChart = new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ["Pemasukkan", "Pengeluaran", "Saldo"],
            datasets: [{
                data: [ {{ $totalPemasukan }}, {{ $totalPengeluaran }}, {{ $saldo }} ],
                backgroundColor: ['#10B981', '#EF4444', '#3B82F6'],
                borderWidth: 3,
                borderColor: '#ffffff',
                hoverBorderWidth: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: { size: 12, weight: 600 },
                        generateLabels: function(chart) {
                            const data = chart.data;
                            if (data.labels.length && data.datasets.length) {
                                return data.labels.map(function(label, i) {
                                    let value = data.datasets[0].data[i];
                                    return {
                                        text: label + ': Rp ' + value.toLocaleString('id-ID'),
                                        fillStyle: data.datasets[0].backgroundColor[i],
                                        strokeStyle: data.datasets[0].backgroundColor[i],
                                        hidden: isNaN(value) || value === null,
                                        index: i
                                    };
                                });
                            }
                            return [];
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let value = context.parsed;
                            return context.label + ': Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
