$(".newTrx").on("click", function () {
  $(".wrapperAddMenu").addClass("d-none");
  $(".wrapperNewTrx").removeClass("d-none");
});
$(".tambahMenu").on("click", function () {
  $(".wrapperNewTrx").addClass("d-none");
  $(".wrapperAddMenu").removeClass("d-none");
});
