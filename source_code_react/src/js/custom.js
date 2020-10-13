/**
 * js file
 */
import $ from "jquery";

$(document).ready(function () {
  if ($("#client-resposibilities").length) {
    $("#client-resposibilities").multiSelect();
  }
  if ($("#contractor-resposibilities").length) {
    $("#contractor-resposibilities").multiSelect();
  }
  if ($("#legal-agreement").length) {
    $("#legal-agreement").multiSelect();
  }

  var winWidth = $(window).outerWidth();

  var content = $(".main-content");
  if (content.length) {
    var offsettop = Math.floor(content.offset().top);
    var contentOffset = "calc(100vh - " + offsettop + "px)";
    content.css("height", contentOffset);
  }

  if ($(".owl-carousel.slider").length) {
    $(".owl-carousel.slider").owlCarousel({
      loop: true,
      nav: true,
      items: 1,
      dots: false,
    });
  }

  function customScroll() {
    var $scrollable = $(".sidebar .nav"),
      $scrollbar = $(".sidebar .scroll"),
      height = $scrollable.outerHeight(true), // visible height
      scrollHeight = $scrollable.prop("scrollHeight"), // total height
      barHeight = (height * height) / scrollHeight; // Scrollbar height!

    var ua = navigator.userAgent;
    if (
      /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Mobile|mobile|CriOS/i.test(
        ua
      )
    ) {
      $scrollable.css({
        margin: 0,
        width: "100%",
      });
    }

    $scrollbar.height(barHeight);

    var scrollableht = Math.round($scrollable.height());
    var scrollbarht = Math.round($scrollbar.height());

    if (scrollableht <= scrollbarht) {
      $scrollbar.hide();
    } else {
      $scrollbar.show();
    }

    // Element scroll:
    $scrollable.on("scroll", function () {
      $scrollbar.css({
        top: ($scrollable.scrollTop() / height) * barHeight,
      });
    });
  }

  $(window).resize(function () {
    customScroll();
  });
  $(".sidebar .nav").on("scroll mouseout mouseover", function () {
    customScroll();
  });
  customScroll();

  $('.attachment input[type="file"]').change(function (e) {
    $(this)
      .next()
      .find(".filename")
      .html(e.target.files[0].name)
      .addClass("active");
    $(this).next().find(".clear").show();
  });
  $(".attachment label span.clear").click(function (e) {
    e.preventDefault();
    var content = $(this).prev(".filename").attr("data-text");
    $(this).prev(".filename").html(content).removeClass("active");
    $(this).parents(".file-select").find("input[type=file]").val("");
    $(this).hide();
  });

  if ($(".file-select .selected-img").length) {
    $('.file-select input[type="file"]').change(function (e) {
      $(this).parent(".file-select").find(".selected-img").show();
      $(this).parent(".file-sel").find("label").hide();
    });
    $(".file-select .selected-img span").click(function () {
      $(this).parents(".file-select").find(".selected-img").hide();
      $(this).parents(".file-sel").find("label").show();
    });
  }
  $("select#m-payment").change(function (e) {
    if ($(this).val() == "other") {
      $("#custom-message").slideDown();
    } else {
      $("#custom-message").hide();
    }
  });

  //  personal jquery
  $(document).on("click", ".open-AcceptDialog", function (e) {
    var name = $(this).data("id");
    var bid = $(this).data("bid");
    var user_id = $(this).data("user_id");
    $(" #tb_user_id").val(user_id);
    $(".modal-body #name").text(name);
    $(".modal-body #bid").text(`${bid}`);
  });
  $(document).on("click", ".open-DeclineDialog", function (e) {
    var user_id = $(this).data("user_id");
    $(" #tb_user_id").val(user_id);
  });
  $(document).on("click", ".remove-row", function () {
    $(this).parent().parent("tr").remove();
    calculateColumn(1);
    calcMultiple(this);
    calculateColumn(3);
    calcTax();
    calcProfit();
    calcTotal();
  });
  $(document).on("keyup", ".duration", function (e) {
    calculateColumn(1, e);
    calcMultiple(this);
    calculateColumn(3, e);
    calcTax();
    calcProfit();
    calcTotal();
  });
  $(document).on("keyup change", ".duration1", function (e) {
    // calculateColumn(1, e);
    calcMultiple1(this);
    calculateColumn(4, e);
    calcTax1(4);
    calcTotal1(4);
  });
  $(document).on("keyup change", ".cost_hr1", function (e) {
    // calculateColumn(2, e);
    calcMultiple1(this);
    calculateColumn(4, e);
    calcTax1(4);
    calcTotal1(4);
  });
  $(document).on("keyup", ".cost_hr", function (e) {
    calculateColumn(2, e);
    calcMultiple(this);
    calculateColumn(3, e);
    calcTax();
    calcProfit();
    calcTotal();
  });
  $(document).on("keyup", ".tax", function (e) {
    calcTax();
    calcTotal();
  });
  $(document).on("keyup change", ".tax1", function (e) {
    calcTax1(4);
    calcTotal1(4);
  });
  $(document).on("keyup", ".profit", function (e) {
    calcProfit();
    calcTotal();
  });

  //  Calculate Multiple
  function calcMultiple(e) {
    var parent = $(e).closest("tr");
    var duration =
      parent.find(".duration").text() == ""
        ? 1
        : parent.find(".duration").text();
    var cost_hr =
      parent.find(".cost_hr").text() == "" ? 1 : parent.find(".cost_hr").text();
    var total = duration * cost_hr;
    parent.find(".mat_cost").text(total);
  }
  //  Calculate Multiple
  function calcMultiple1(e) {
    var parent = $(e).closest("tr");
    var duration =
      parent.find(".duration1").text() == ""
        ? 1
        : parent.find(".duration1").text();
    var cost_hr =
      parent.find(".cost_hr1").text() == ""
        ? 1
        : parent.find(".cost_hr1").text();
    var total = duration * cost_hr;
    parent.find(".mat_cost1").text(total);
  }

  //  Calculate Total
  function calcTotal() {
    var sub_total = $("#3result").text();
    var tax_res = $(".tax_res").text();
    var profit_res = $(".profit_res").text();
    var total =
      parseFloat(sub_total) + parseFloat(tax_res) + parseFloat(profit_res);
    $(`.total`).text(total);
    $(`#total`).val(total);
  }
  //  Calculate Total
  function calcTotal1(index) {
    var sub_total = $(`#${index}result`).text();
    var tax_res = $(".tax_res").text();

    var total = parseFloat(sub_total) + parseFloat(tax_res);
    $(`.total`).text(total);
  }

  //  Calculate Tax%
  function calcTax() {
    var mat_cost = $("#3result").text();
    var tax = $(".tax").text();
    $(`.tax_res`).text((tax / 100) * mat_cost);
  }
  //  Calculate Tax%
  function calcTax1(index) {
    var mat_cost = $(`#${index}result`).text();
    var tax = $(".tax1").text();
    $(`.tax_res`).text((tax / 100) * mat_cost);
  }
  //  Calculate Profit%
  function calcProfit() {
    var mat_cost = $("#3result").text();
    var profit = $(".profit").text();
    $(`.profit_res`).text((profit / 100) * mat_cost);
  }
  // Add cloumns
  function calculateColumn(index) {
    // if (
    //   (e.which >= 48 && e.which <= 57) ||
    //   e.which == 8 ||
    //   e.which == 46
    // ) {
    var total = 0;
    $("table tr.i-val").each(function () {
      var value = parseInt($("td", this).eq(index).text());
      if (!isNaN(value)) {
        total += value;
      }
    });
    $(`#${index}result`).text(total);
    // } else {
    //   return $("table tr.i-val td")
    //     .eq(index)
    //     .text("");
    // }
  }

  $(document).on("keyup", ".my-input", function (e) {
    // just get keyup event
    var total = 0;
    // on every keyup, loop all the elements and add all the results
    $(".my-input").each(function (index, element) {
      var val = parseFloat($(element).val());
      if (!isNaN(val)) {
        total += val;
      }
    });
    $("#c_total").text(`${total}`);
    let fee = $("#config").val();
    $("#per").text(`${calculatePercent(fee, total)}`);
    let _fee = calculatePercent(fee, total);
    $("#1_est").text(`${calculateSub(_fee, total)}`);

    // for hidden fields
    $("._fee").val(`${calculatePercent(fee, total)}`);
    $("._est_pay").val(`${calculateSub(_fee, total)}`);
    $("._c_total").val(`${total}`);
    $(`#rate_`).text($(`._c_total`).val());
  });

  $("._c_total").val(`${0}`);

  $(document).on("click", ".remove-input", function () {
    $(this).parent().parent(".row").remove();
    var total = 0;
    // on every keyup, loop all the elements and add all the results
    $(".my-input").each(function (index, element) {
      var val = parseFloat($(element).val());
      if (!isNaN(val)) {
        total += val;
      }
    });

    $("#c_total").text(` ${total}`);
    let fee = $("#config").val();
    $("#per").text(`${calculatePercent(fee, total)}`);
    let _fee = calculatePercent(fee, total);
    $("#1_est").text(`${calculateSub(_fee, total)}`);

    // for hidden fields
    $("._fee").val(`${calculatePercent(fee, total)}`);
    $("._est_pay").val(`${calculateSub(_fee, total)}`);
    $("._c_total").val(`${total}`);
  });
  $(document).on("keyup", ".my-input1", function (e) {
    // just get keyup event
    var total = 0;
    // on every keyup, loop all the elements and add all the results
    $(".my-input1").each(function (index, element) {
      var val = parseFloat($(element).val());
      if (!isNaN(val)) {
        total += val;
      }
    });
    let fee = $("#config1").val();
    $(".fee1").val(`${calculatePercent(fee, total)}`);
    $("#per").val(`${calculatePercent(fee, total)}`);
    let _fee = calculatePercent(fee, total);
    $("#1_est").val(`${calculateSub(_fee, total)}`);
    $("#c_total1").val(`${calculateSub(_fee, total)}`);

    // for hidden fields
    $("._fee").val(`${calculatePercent(fee, total)}`);
    $("._est_pay").val(`${calculateSub(_fee, total)}`);
    $("._c_total").val(`${total}`);
  });

  function calculatePercent(percent, num) {
    return (percent / 100) * num;
  }
  function calculateSub(num1, num2) {
    return num2 - num1;
  }

  $(document).on("click", ".clk", function (e) {
    e.preventDefault();
    let gg;
    let arr = [];
    $(".customerIDCell").each(function (index, tr) {
      var element = document.getElementById("myRemove");
      element.remove();
      var lines = $("td", tr).map(function (index, td) {
        return $(td).text();
      });
      gg = `${lines[0]},${lines[1]},${lines[2]},${lines[3]}`.split(",");

      var keys = ["items", "dur", "cost", "mat"];

      var result = {};
      keys.forEach((key, i) => (result[key] = gg[i]));

      arr.push(result);
    });
    $(`#items`).val(JSON.stringify(arr));
    $(`#est_time`).val($(`#1result`).text());
    $(`#sub_total`).val($(`#2result`).text());
    $(`#items_cost`).val($(`#3result`).text());
    $(`#tax`).val($(`.tax`).text());
    $(`#profit`).val($(`.profit`).text());
    $(`#tax_calc`).val($(`.tax_res`).text());
    $(`#profit_calc`).val($(`.profit_res`).text());
    $(`#total`).val($(`#total`).val());
  });

  $(document).on("click", ".clk1", function (e) {
    e.preventDefault();
    let gg;
    let arr = [];
    $(".customerIDCell").each(function (index, tr) {
      var element = document.getElementById("myRemove");
      element.remove();
      var lines = $("td", tr).map(function (index, td) {
        return $(td).text();
      });
      gg = `${lines[0]},${lines[1]},${lines[2]},${lines[3]}`.split(",");

      var keys = ["items", "dur", "cost", "mat"];

      var result = {};
      keys.forEach((key, i) => (result[key] = gg[i]));

      arr.push(result);
    });
    $(`#items`).val(JSON.stringify(arr));
    $(`#est_time`).val($(`#1result`).text());
    $(`#sub_total`).val($(`#2result`).text());
    $(`#items_cost`).val($(`#3result`).text());
    $(`#tax`).val($(`.tax`).text());
    $(`#profit`).val($(`.profit`).text());
    $(`#tax_calc`).val($(`.tax_res`).text());
    $(`#profit_calc`).val($(`.profit_res`).text());
    $(`#total`).val(
      $(`.total`)
        .text()
        .replace(/[^0-9]/g, "")
    );
  });

  $(document).on("click", ".clk2", function (e) {
    e.preventDefault();
    let gg;
    let arr = [];
    $(".milestone").each(function (index, item) {
      var lines = $("input", item).map(function (index, input) {
        return $(input).val() || $(input).attr("placeholder");
      });
      gg = `${lines[0]},${lines[1]},${lines[2]}`.split(",");
      var keys = ["des", "due_date", "amount"];

      var result = {};
      keys.forEach((key, i) => (result[key] = gg[i]));

      arr.push(result);
      $(`._milestone`).val(JSON.stringify(arr));
    });
    $(`._fee`).val($("._fee").val() || $("#per").text());
    $(`._est_pay`).val($(`._est_pay`).val() || $("#1_est").text());
    $(`._c_total`).val($(`._c_total`).val() || $("#c_total").text());
  });

  $(document).on("click", ".clk3", function (e) {
    e.preventDefault();
    let gg;
    let arr = [];
    $(".customerIDCell").each(function (index, tr) {
      var element = document.getElementById("myRemove");
      element.remove();
      var lines = $("td", tr).map(function (index, td) {
        return $(td).text();
      });
      gg = `${lines[0]},${lines[1]},${lines[2]},${lines[3]},${lines[4]}`.split(
        ","
      );

      var keys = ["items", "qty", "unit", "price", "amount"];

      var result = {};
      keys.forEach((key, i) => (result[key] = gg[i]));

      arr.push(result);
    });
    $(`#_items`).val(JSON.stringify(arr));
    $(`#_sub_total`).val($(`#4result`).text());
    $(`#_tax`).val($(`.tax1`).text());
    $(`#_tax_calc`).val($(`.tax_res`).text());
    $(`#_total`).val(
      $(`.total`)
        .text()
        .replace(/[^0-9]/g, "")
    );
  });

  /* 1. Visualizing things on Hover - See next part for action on click */
  $("#stars li")
    .on("mouseover", function () {
      var onStar = parseInt($(this).data("value"), 10); // The star currently mouse on

      // Now highlight all the stars that's not after the current hovered star
      $(this)
        .parent()
        .children("li.star")
        .each(function (e) {
          if (e < onStar) {
            $(this).addClass("hover");
          } else {
            $(this).removeClass("hover");
          }
        });
    })
    .on("mouseout", function () {
      $(this)
        .parent()
        .children("li.star")
        .each(function (e) {
          $(this).removeClass("hover");
        });
    });

  if ($("#stars").length) {
    $("#stars li")
      .on("mouseover", function () {
        var onStar = parseInt($(this).data("value"), 10); // The star currently mouse on
        // Now highlight all the stars that's not after the current hovered star
        $(this)
          .parent()
          .children("li.star")
          .each(function (e) {
            if (e < onStar) {
              $(this).addClass("hover");
            } else {
              $(this).removeClass("hover");
            }
          });
      })
      .on("mouseout", function () {
        $(this)
          .parent()
          .children("li.star")
          .each(function (e) {
            $(this).removeClass("hover");
          });
      });

    /* 2. Action to perform on click */
    $("#stars li").on("click", function () {
      var onStar = parseInt($(this).data("value"), 10); // The star currently selected
      var stars = $(this).parent().children("li.star");
      var count = 0;
      for (let i = 0; i < stars.length; i++) {
        $(stars[i]).removeClass("selected");
      }

      for (let i = 0; i < onStar; i++) {
        $(stars[i]).addClass("selected");
        count += $(stars[i]).length;
        $("#stars").next(".count").find("span").text(count);
        $("#stars")
          .next(".count")
          .find("._rating")
          .val(count || 0);
      }

      // JUST RESPONSE (Not needed)
      var ratingValue = parseInt(
        $("#stars li.selected").last().data("value"),
        10
      );
    });
  }

  //  jquery end

  //$('.apply-form .file-select input[type=file]').change(function(e){
  //    $(this).next().find(".filename").html(e.target.files[0].name).addClass("active");
  //    $(this).next().find(".clear").show();
  //});
  //$(".apply-form .file-select label span.clear").click(function(e){
  //    e.preventDefault();
  //    $(this).prev(".filename").html("Liita portfolio / CV").removeClass("active");
  //    $(this).parents(".file-select").find("input[type=file]").val('');
  //    $(this).hide();
  //});
});
