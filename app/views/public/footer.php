    <!-- Footer Start -->
    <footer class="footer fixed bottom-0 right-0 left-0 border-t border-gray-50 py-5 px-5 bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-200">
      <div class="grid grid-cols-2">

        <div class="hidden md:inline-block text-start">دیزاین و توسعه توسط <a href="#" class="text-violet-500 underline">Yegi</a></div>
        <div class="grow lg:text-left">
          &copy;
          <script>
            document.write(new Date().getFullYear());
          </script> AK WARRANTY
        </div>
      </div>
    </footer>
    <!-- end Footer -->
    </div>





    <script src="<?php echo URLROOT . "/assets/libs/%40popperjs/core/umd/popper.min.js" ?>"></script>
    <script src="<?php echo URLROOT . "/assets/libs/feather-icons/feather.min.js" ?>"></script>
    <script src="<?php echo URLROOT . "/assets/libs/metismenujs/metismenujs.min.js" ?>"></script>
    <script src="<?php echo URLROOT . "/assets/libs/simplebar/simplebar.min.js" ?>"></script>
    <script src="<?php echo URLROOT . "/assets/libs/feather-icons/feather.min.js" ?>"></script>


    <script src="<?php echo URLROOT . "/code.jquery.com/jquery-3.6.0.min.js" ?>" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- apexcharts -->
    <script src="<?php echo URLROOT . "/assets/libs/apexcharts/apexcharts.min.js" ?>"></script>
    <!-- Plugins js-->
    <script src="<?php echo URLROOT . "/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js" ?>"></script>
    <script src="<?php echo URLROOT . "/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js" ?>"></script>
    <!-- dashboard init -->
    <script src="<?php echo URLROOT . "/assets/js/pages/dashboard.init.js" ?>"></script>

    <script src="<?php echo URLROOT . "/assets/js/pages/nav%26tabs.js" ?>"></script>

    <script src="<?php echo URLROOT . "/assets/libs/swiper/swiper-bundle.min.js" ?>"></script>

    <script src="<?php echo URLROOT . "/assets/js/pages/login.init.js" ?>"></script>

    <script src="<?php echo URLROOT . "/assets/js/app.js" ?>"></script>

    <!-- datepicker js -->
    <script src="<?php echo URLROOT . "/assets/js/jdate.min.js" ?>"></script>
    <script>
      window.Date = window.JDate;
    </script>
    <script src="<?php echo URLROOT . "/assets/libs/flatpickr/flatpickr.min.js" ?>"></script>
    <script src="<?php echo URLROOT . "/assets/js/flatpicker_fa.js" ?>"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#example-full-input", {
          dateFormat: "Y/m/d",
          altInput: true,
          altFormat: "j F Y",
          locale: "fa",
          calendar: "persian",
          defaultDate: "today",
        });
      });
    </script>





    </body>


    </html>