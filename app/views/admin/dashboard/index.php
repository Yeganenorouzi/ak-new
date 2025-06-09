<?php
use Hekmatinasser\Verta\Verta;
?>
<?php require_once(APPROOT . "/views/public/header.php"); ?>

<div class="main-content flex-grow ">
  <div class="page-content dark:bg-zinc-700">
    <div class="container-fluid px-[0.625rem]">

      <div class="grid grid-cols-1 mb-5">
        <div class="flex items-center justify-between">
          <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">داشبورد</h4>

          <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
              <li class="inline-flex items-center">
                <a href="<?php echo URLROOT; ?>/admin/dashboard/index.php"
                  class="inline-flex items-center text-sm font-medium text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                  داشبورد
                </a>
              </li>
              <li>
                <div class="flex items-center">
                  <svg class="w-4 h-4 text-gray-400 -rotate-180" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                      clip-rule="evenodd"></path>
                  </svg>
                  <a href="#"
                    class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">داشبورد</a>
                </div>
              </li>
            </ol>
          </nav>
        </div>
      </div>

      <!-- Action Buttons Section -->
      <div class="mb-6">
        <div class="flex items-center gap-3">
          <a href="<?php echo URLROOT; ?>/users/create"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors duration-200 shadow-lg"
            style="background-color: #16a34a; color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; display: inline-flex; align-items: center; gap: 8px; font-weight: 500;">
            <span style="font-size: 18px; font-weight: bold;">+</span>
            <i class="ri-user-add-line text-lg"></i>
            کاربر جدید
          </a>
          <a href="<?php echo URLROOT; ?>/cards/create"
            class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors duration-200 shadow-lg"
            style="background-color: #ea580c; color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; display: inline-flex; align-items: center; gap: 8px; font-weight: 500;">
            <span style="font-size: 18px; font-weight: bold;">+</span>
            <i class="ri-bank-card-line text-lg"></i>
            کارت گارانتی جدید
          </a>
        </div>
      </div>

      <main class="w-full p-8">
        <!-- Main grid container for cards and table -->
        <div class="grid grid-cols-2 gap-6 mb-8">
          <!-- Left side - Cards -->
          <div class="grid grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-6 text-center">
              <h3 class="text-lg font-semibold">تعداد کل پذیرش ها</h3>
              <p class="text-2xl font-bold text-blue-600 mt-2"><?php echo $data['total_receptions']; ?></p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
              <h3 class="text-lg font-semibold"> تعداد کل کارت گارانتی ها </h3>
              <p class="text-2xl font-bold text-yellow-600 mt-2"><?php echo $data['total_cards']; ?></p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
              <h3 class="text-lg font-semibold"> تعداد ادمین ها </h3>
              <p class="text-2xl font-bold text-green-600 mt-2"><?php echo $data['total_admins']; ?></p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
              <h3 class="text-lg font-semibold"> تعداد نمایندگان </h3>
              <p class="text-2xl font-bold text-blue-600 mt-2"><?php echo $data['total_agents']; ?></p>
            </div>
          </div>

          <!-- Right side - Recent Receptions Table -->
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-semibold text-gray-800">آخرین پذیرش‌ها</h3>
              <a href="<?php echo URLROOT; ?>/receptions"
                class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center">
                مشاهده همه
                <i class="ri-arrow-left-s-line mr-1"></i>
              </a>
            </div>

            <div class="overflow-x-auto">
              <table class="w-full text-sm">
                <thead>
                  <tr class="border-b border-gray-200">
                    <th class="text-right py-2 font-medium text-gray-600">شماره پذیرش</th>
                    <th class="text-right py-2 font-medium text-gray-600">نام مشتری</th>
                    <th class="text-right py-2 font-medium text-gray-600">تاریخ</th>
                    <th class="text-right py-2 font-medium text-gray-600">وضعیت</th>
                  </tr>
                </thead>
                <tbody>


                  <?php if (!empty($data['recent_receptions'])): ?>
                    <?php foreach ($data['recent_receptions'] as $reception): ?>
                      <?php
                      // نمایش تاریخ شمسی با ساعت
                      $shamsiDate = new Verta($reception->created_at);
                      $displayDate = $shamsiDate->format('Y/m/d _ H:i');
                      ?>
                      <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-3 text-gray-800">#<?php echo $reception->id; ?></td>
                        <td class="py-3 text-gray-800"><?php echo htmlspecialchars($reception->customer_name); ?></td>
                        <td class="py-3 text-gray-600"><?php echo $displayDate; ?></td>
                        <td class="py-3 text-gray-800">
                          <?php echo htmlspecialchars($reception->product_status); ?>
                        </td>
                        <td class="py-3 text-center">
                          <a href="<?php echo URLROOT; ?>/receptions/view/<?php echo $reception->id; ?>"
                            class="text-blue-600 hover:text-blue-700">
                            <i class="ri-eye-line"></i>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="5" class="py-6 text-center text-gray-500">
                        هیچ پذیرشی یافت نشد
                      </td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Chart Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 dark:bg-zinc-800 dark:border dark:border-zinc-600">
          <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
            <div class="mb-4 lg:mb-0">
              <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-1">📊 نمودار وضعیت پذیرش‌ها</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">نمایش آماری پذیرش‌ها بر اساس وضعیت</p>
            </div>

            <!-- Compact Filter Controls -->
            <div class="bg-gray-50 dark:bg-zinc-700 rounded-lg p-3 border border-gray-200 dark:border-zinc-600">
              <div class="flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2">
                  <label for="startDate"
                    class="text-xs font-medium text-gray-600 dark:text-gray-300 whitespace-nowrap">از:</label>
                  <input type="text" id="startDate" data-jdp placeholder="تاریخ شروع"
                    class="w-28 text-xs rounded border border-gray-300 dark:border-zinc-600 px-2 py-1 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:bg-zinc-600 dark:text-gray-100">
                </div>
                <div class="flex items-center gap-2">
                  <label for="endDate"
                    class="text-xs font-medium text-gray-600 dark:text-gray-300 whitespace-nowrap">تا:</label>
                  <input type="text" id="endDate" data-jdp placeholder="تاریخ پایان"
                    class="w-28 text-xs rounded border border-gray-300 dark:border-zinc-600 px-2 py-1 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:bg-zinc-600 dark:text-gray-100">
                </div>
                <div class="flex gap-1">
                  <button id="applyFilter"
                    class="bg-blue-600 text-white px-3 py-1 text-xs rounded hover:bg-blue-700 transition-colors duration-200 flex items-center gap-1">
                    <i class="ri-filter-line text-xs"></i>
                    فیلتر
                  </button>
                  <button id="clearFilter"
                    class="bg-gray-500 text-white px-3 py-1 text-xs rounded hover:bg-gray-600 transition-colors duration-200 flex items-center gap-1">
                    <i class="ri-close-line text-xs"></i>
                    حذف
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Chart Container with better styling -->
          <div class="bg-gray-50 dark:bg-zinc-700 rounded-lg p-4 border border-gray-200 dark:border-zinc-600">
            <div class="h-[500px] w-full">
              <canvas id="statusChart" style="height: 500px !important;"></canvas>
            </div>
          </div>

          <!-- Chart Info -->
          <div class="mt-4 flex flex-wrap items-center justify-between text-xs text-gray-500 dark:text-gray-400">
            <div class="flex items-center gap-4">
              <span class="flex items-center gap-1">
                <div class="w-3 h-3 bg-blue-600 rounded"></div>
                تعداد پذیرش‌ها
              </span>
            </div>
            <div class="flex items-center gap-1">
              <i class="ri-information-line"></i>
              <span>برای فیلتر کردن، تاریخ شروع و پایان را انتخاب کنید</span>
            </div>
          </div>
        </div>

      </main>

    </div> <!-- پایان container-fluid -->
  </div> <!-- پایان page-content -->
</div> <!-- پایان main-content -->

<?php require_once(APPROOT . "/views/public/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/jalali-moment@3.3.11/dist/jalali-moment.browser.js"></script>
<script>
  // اطمینان از اینکه DOM و کتابخانه‌ها آماده هستند
  document.addEventListener('DOMContentLoaded', function () {
    // چک کردن اینکه Chart.js لود شده باشد
    if (typeof Chart === 'undefined') {
      console.error('Chart.js is not loaded');
      return;
    }

    const ctx = document.getElementById('statusChart');
    if (!ctx) {
      console.error('Chart canvas element not found');
      return;
    }

    let chart;

    // Function to convert Persian date to Gregorian
    function convertPersianToGregorian(persianDate) {
      if (!persianDate) return '';

      try {
        // Parse Persian date (format: YYYY/MM/DD)
        const jalaliMoment = moment(persianDate, 'jYYYY/jMM/jDD');
        if (jalaliMoment.isValid()) {
          return jalaliMoment.format('YYYY-MM-DD');
        }
        return '';
      } catch (error) {
        console.error('Error converting Persian date:', error);
        return '';
      }
    }

    // Function to fetch filtered data
    async function fetchFilteredData(startDate, endDate) {
      try {
        const response = await fetch(`<?php echo URLROOT; ?>/dashboard/getFilteredData`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            startDate,
            endDate
          })
        });

        if (!response.ok) {
          throw new Error('Network response was not ok');
        }

        return await response.json();
      } catch (error) {
        console.error('Error fetching filtered data:', error);
        return null;
      }
    }

    // Function to update chart with new data
    function updateChart(data) {
      if (chart) {
        chart.destroy();
      }

      chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: data.status_labels,
          datasets: [{
            label: 'تعداد پذیرش‌ها',
            data: data.status_counts,
            backgroundColor: [
              '#3B82F6', // Blue
              '#10B981', // Green  
              '#F59E0B', // Yellow
              '#EF4444', // Red
              '#8B5CF6', // Purple
              '#06B6D4', // Cyan
              '#84CC16', // Lime
              '#F97316', // Orange
              '#EC4899', // Pink
              '#6B7280'  // Gray
            ],
            borderColor: [
              '#2563EB',
              '#059669',
              '#D97706',
              '#DC2626',
              '#7C3AED',
              '#0891B2',
              '#65A30D',
              '#EA580C',
              '#DB2777',
              '#4B5563'
            ],
            borderWidth: 2,
            maxBarThickness: 60,
            barThickness: 45,
            borderRadius: 6,
            borderSkipped: false,
            hoverBackgroundColor: [
              '#2563EB',
              '#059669',
              '#D97706',
              '#DC2626',
              '#7C3AED',
              '#0891B2',
              '#65A30D',
              '#EA580C',
              '#DB2777',
              '#4B5563'
            ],
            hoverBorderWidth: 3
          }]
        },
        options: {
          maintainAspectRatio: false,
          responsive: true,
          height: 500,
          plugins: {
            legend: {
              display: true,
              position: 'top',
              labels: {
                font: {
                  family: 'IRANSans',
                  size: 12,
                  weight: 'bold'
                },
                padding: 20,
                usePointStyle: true,
                pointStyle: 'circle'
              }
            },
            tooltip: {
              backgroundColor: 'rgba(0, 0, 0, 0.8)',
              titleColor: '#fff',
              bodyColor: '#fff',
              borderColor: '#3B82F6',
              borderWidth: 1,
              cornerRadius: 6,
              font: {
                family: 'IRANSans'
              },
              callbacks: {
                label: function (context) {
                  return ` ${context.parsed.y} پذیرش: ${context.label}`;
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              max: function (context) {
                const maxValue = Math.max(...context.chart.data.datasets[0].data);
                // If max value is more than 50, set a reasonable limit
                return maxValue > 50 ? Math.ceil(maxValue * 1.1) : undefined;
              },
              grid: {
                display: true,
                color: 'rgba(0, 0, 0, 0.1)',
                drawBorder: false
              },
              ticks: {
                stepSize: function (context) {
                  const maxValue = Math.max(...context.chart.data.datasets[0].data);
                  if (maxValue > 100) return 20;
                  if (maxValue > 50) return 10;
                  if (maxValue > 20) return 5;
                  return 1;
                },
                maxTicksLimit: 8,
                precision: 0,
                font: {
                  family: 'IRANSans',
                  size: 11
                },
                color: '#6B7280',
                padding: 10,
                callback: function (value) {
                  return value; // فقط عدد، بدون کلمه پذیرش
                }
              },
              title: {
                display: true,
                text: 'تعداد پذیرش‌ها',
                font: {
                  family: 'IRANSans',
                  size: 12,
                  weight: 'bold'
                },
                color: '#374151'
              }
            },
            x: {
              grid: {
                display: false
              },
              ticks: {
                font: {
                  family: 'IRANSans',
                  size: 10
                },
                color: '#6B7280',
                maxRotation: 45,
                minRotation: 0,
                padding: 10
              },
              title: {
                display: true,
                text: 'وضعیت پذیرش‌ها',
                font: {
                  family: 'IRANSans',
                  size: 12,
                  weight: 'bold'
                },
                color: '#374151'
              }
            }
          },
          elements: {
            bar: {
              borderRadius: 4,
              borderSkipped: false,
            }
          },
          onHover: (event, activeElements) => {
            event.native.target.style.cursor = activeElements.length > 0 ? 'pointer' : 'default';
          }
        }
      });
    }

    // Initialize chart with default data
    try {
      updateChart({
        status_labels: <?php echo json_encode($data['status_labels']); ?>,
        status_counts: <?php echo json_encode($data['status_counts']); ?>
      });
    } catch (error) {
      console.error('Error initializing chart:', error);
    }

    // Add event listener for filter button
    const applyFilterBtn = document.getElementById('applyFilter');
    if (applyFilterBtn) {
      applyFilterBtn.addEventListener('click', async () => {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        if (!startDate || !endDate) {
          alert('لطفا هر دو تاریخ را انتخاب کنید');
          return;
        }

        // Convert Persian dates to Gregorian for server request
        const gregorianStartDate = convertPersianToGregorian(startDate);
        const gregorianEndDate = convertPersianToGregorian(endDate);

        if (!gregorianStartDate || !gregorianEndDate) {
          alert('لطفا تاریخ‌های معتبر وارد کنید');
          return;
        }

        const filteredData = await fetchFilteredData(gregorianStartDate, gregorianEndDate);
        if (filteredData) {
          updateChart(filteredData);
        }
      });
    }

    // Add event listener for clear filter button
    const clearFilterBtn = document.getElementById('clearFilter');
    if (clearFilterBtn) {
      clearFilterBtn.addEventListener('click', () => {
        // Clear date inputs
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');

        if (startDateInput) startDateInput.value = '';
        if (endDateInput) endDateInput.value = '';

        // Reset chart to original data
        updateChart({
          status_labels: <?php echo json_encode($data['status_labels']); ?>,
          status_counts: <?php echo json_encode($data['status_counts']); ?>
        });
      });
    }
  });
</script>
</script>