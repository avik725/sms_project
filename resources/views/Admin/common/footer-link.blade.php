<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
  integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('admin-assets/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/sidebarmenu.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/app.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/libs/simplebar/dist/simplebar.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/dashboard.js')}}"></script>
<script src="{{asset('admins-assets/assets/js/fancybox.js')}}"></script>

<!-- ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Fancybox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
  integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Selectize JS -->
<script>
  let selects = document.querySelectorAll('#dashboard-page .selectize-cards select, #purchase-page select, #sales-page select');
  $(document).ready(function () {
    selects.forEach(select => {
      $(select).selectize({ maxItems: 1 });
    });
  });
</script>

<!-- SweetAlert PHP -->

@if(Session::has('success'))
  <script type="text/javascript">
    $(document).ready(function () {
    Swal.fire({
      title: 'Success!',
      text: '{{ session("success") }}',
      icon: 'success',
      confirmButtonText: 'Close'
    });
    });
  </script>
  @php
  Session::forget('success');
@endphp
@endif
@if(Session::has('error'))
  <script type="text/javascript">
    $(document).ready(function () {
    Swal.fire({
      title: 'Error!',
      text: '{{ session("error") }}',
      icon: 'error',
      confirmButtonText: 'Close'
    });
    });
  </script>
  @php
  Session::forget('error');
@endphp
@endif

<!-- Stock levels Fetch  -->
<script>
  var getStockLevelUrl =
    "{{ route('get-stock-levels', ['item_id' => ':itemId']) }}";

  $(".stock-level").on("change", "#item_id", function () {
    console.log("Change Event Triggered"); // Debug point

    let itemId = $(this).val();
    console.log("Selected Item ID:", itemId); // Debug point

    let stockCard = $(this).closest(".stock-level");
    console.log("Stock Card Found:", stockCard.length); // Debug point

    if (itemId) {
      $.ajax({
        url: getStockLevelUrl.replace(":itemId", itemId), // Replaces :itemId with the selected item's ID
        method: "GET",
        success: function (response) {
          console.log("Response Received:", response); // Debug point

          if (response.status === "success") {
            stockCard
              .find("#remaining-stock")
              .text(Math.floor(response.stock_level));
            stockCard
              .find('#unit_name')
              .text(" " + response.unit + "s");
            stockCard
              .find('#category_name')
              .text((response.category_name) + " | " + (response.subcategory_name));
          } else {
            stockCard
              .find("#remaining-stock")
              .text("Could Not Be Fetched");
            stockCard
              .find("#unit_name")
              .text(" ");
            stockCard
              .find("#category_name")
              .text("NA");
          }
        },
        error: function (xhr, status, error) {
          console.error("Error:", status, error); // Debug point
          stockCard.find("#remaining-stock").text("Out Of Stock");
          stockCard.find("#unit_name").text("");
          stockCard.find("#category_name").text("NA");
        },
      });
    } else {
      stockCard.find("#remaining-stock").text("Select an item");
      stockCard.find("#category_name").text("Select an item");
    }
  });
</script>

<!-- No Of Items Fetch -->
<script>
  var getNoOfItemsUrl =
    "{{ route('get-no-of-items', ['category_id' => ':categoryId']) }}";

  $(".category_items").on("change", "#category_id", function () {
    console.log("Change Event Triggered"); // Debug point

    let categoryId = $(this).val();
    console.log("Selected Category ID:", categoryId); // Debug point

    let stockCard = $(this).closest(".category_items");
    console.log("Stock Card Found:", stockCard.length); // Debug point

    if (categoryId) {
      $.ajax({
        url: getNoOfItemsUrl.replace(":categoryId", categoryId), // Replaces :itemId with the selected item's ID
        method: "GET",
        success: function (response) {
          console.log("Response Received:", response); // Debug point

          if (response.status === "success") {
            stockCard
              .find("#no_of_items")
              .text(Math.floor(response.no_of_items));
            const subcategoryNames = response.subcategories
              .map(subcat => subcat.subcategory)
              .join(", ");

            stockCard
              .find('#subcategories_names')
              .text(subcategoryNames);
          } else {
            stockCard
              .find("#no_of_items")
              .text("Could Not Be Fetched");
            stockCard
              .find("#subcategories_names")
              .text("NA");
          }
        },
        error: function (xhr, status, error) {
          console.error("Error:", status, error); // Debug point
          stockCard.find("#no_of_items").text("NA");
          stockCard.find("#subcategories_names").text("");
        },
      });
    } else {
      stockCard.find("#no_of_items-stock").text("Select an Category");
      stockCard.find("#subcategories_names").text("NA");
    }
  });
</script>

<!-- Dashboard Chart Initialize script  -->
<script>
  function getLastFourMonths() {
    const currentDate = new Date();
    const months = [];
    for (let i = 0; i < 4; i++) {
      const month = currentDate.getMonth() - i;
      const year = currentDate.getFullYear() + Math.floor(month / 12);
      const adjustedMonth = ((month + 12) % 12) + 1; // 1-indexed month
      months.push({
        year,
        month: adjustedMonth.toString().padStart(2, "0"),
      });
    }
    return months;
  }

  function populateMonthFilter() {
    const monthFilter = document.getElementById("monthFilter");
    monthFilter.innerHTML = "";

    const defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.textContent = "Select Month";
    defaultOption.selected = true;
    monthFilter.appendChild(defaultOption);

    const months = getLastFourMonths();
    months.forEach(({ year, month }) => {
      const date = new Date(year, month - 1);
      const monthName = date.toLocaleString("default", { month: "long" });
      const option = document.createElement("option");
      option.value = `${year}-${month}`;
      option.textContent = `${monthName} ${year}`;
      monthFilter.appendChild(option);
    });
  }

  async function fetchAndRenderChart(monthYear = "") {
    try {
      const response = await fetch(
        `/api/category-sales-restocks?monthYear=${monthYear}`
      );
      const data = await response.json();

      const categories = data.map((item) => item.category);
      const sales = data.map((item) => item.sales || 0);
      const restocks = data.map((item) => item.restocks || 0);

      const chartConfig = {
        series: [
          { name: "Sales", data: sales },
          { name: "Restocks", data: restocks },
        ],
        chart: {
          type: "bar",
          height: 345,
          offsetX: -15,
          toolbar: { show: true },
          foreColor: "#adb0bb",
          fontFamily: "inherit",
          sparkline: { enabled: false },
        },
        colors: ["#5D87FF", "#49BEFF"],
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "35%",
            borderRadius: [6],
            borderRadiusApplication: "end",
            borderRadiusWhenStacked: "all",
          },
        },
        xaxis: {
          categories: categories,
          labels: {
            style: {
              cssClass: "grey--text lighten-2--text fill-color",
            },
          },
        },
        yaxis: {
          labels: { formatter: (value) => value.toFixed(0) },
        },
        tooltip: {
          y: { formatter: (value) => `${value} units` },
        },
        legend: {
          show: true,
          position: "bottom",
          markers: {
            shape: "circle",
            width: 12,
            height: 12,
          },
          itemMargin: {
            horizontal: 10,
            vertical: 5,
          },
        },
        dataLabels: { enabled: false },
        stroke: { show: true, width: 3, colors: ["transparent"] },
        responsive: [
          {
            breakpoint: 600,
            options: {
              plotOptions: {
                bar: { borderRadius: 3 },
              },
            },
          },
        ],
      };

      const chartContainer = document.querySelector("#chart");
      chartContainer.innerHTML = ""; // Clear the existing chart
      const chart = new ApexCharts(chartContainer, chartConfig);
      chart.render();
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  }

  document.addEventListener("DOMContentLoaded", () => {
    populateMonthFilter();
    fetchAndRenderChart();

    document
      .getElementById("monthFilter")
      .addEventListener("change", (event) => {
        const selectedMonthYear = event.target.value;
        fetchAndRenderChart(selectedMonthYear);
      });
  });

</script>