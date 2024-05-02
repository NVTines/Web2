$(document).ready(() => {
  // Initialize price slider
  const minPrice = parseInt($("#minimum_price").val());
  const maxPrice = parseInt($("#maximum_price").val());
  $("#price_range").slider({
    range: true,
    min: minPrice,
    max: maxPrice,
    values: [minPrice, maxPrice],
    step: 1,
    stop: (event, ui) => {
      $("#price_text").html(
        ui.values[0] + " VNĐ" + " - " + ui.values[1] + " VNĐ"
      );
      $("#minimum_price").val(ui.values[0]);
      $("#maximum_price").val(ui.values[1]);
      filter_product(1);
    },
  });

  // Event handlers for filter inputs
  $("input[type=checkbox], input#searchKeyword").on("click keyup input", () => {
    filter_product(1);
  });

  // Event handler for pagination links
  $(document).on("click", ".page-link", (e) => {
    filter_product($(e.currentTarget).data("page"));
  });

  // Function to extract checked values from checkboxes
  function get_filtered_product(filter_id) {
    var filtered_data = [];
    $("#" + filter_id + ":checked").each(function () {
      filtered_data.push("'" + $(this).val() + "'");
    });
    return filtered_data;
  }

  // Function to filter products based on selected filters
  const filter_product = (page) => {
    var action = "filterRequest";
    var minPrice = $("#minimum_price").val();
    var maxPrice = $("#maximum_price").val();
    var brand = get_filtered_product("brand");
    var category = get_filtered_product("category");
    var size = get_filtered_product("size");
    var searchKeyword = $("#searchKeyword").val();

    $.ajax({
      url: "pages/functions/process_filter.php",
      method: "POST",
      data: {
        action: action,
        page: page,
        minimumPrice: minPrice,
        maximumPrice: maxPrice,
        brand: brand,
        category: category,
        size: size,
        searchKeyword: searchKeyword,
      },
      beforeSend: () => {
        $("#productsContainer").html(`
            <div class="card min-h-400px col-lg-12">
              <div class="card-body justify-align-center">
                <div class="spinner-border" role="status"></div>
              </div>
            </div>
          `);
        $("#pagination").html("");
      },
      success: (res) => {
        try {
          res = JSON.parse(res);
          const products = res.products;
          const pagination = res.pagination;
          $("#productsContainer").html(products);
          $("#pagination").html(pagination);
        } catch (e) {
          alert(e);
        }
      },
      error: () => {
        alert("Error in sending request");
      },
    });
  };

  filter_product(1);
});
