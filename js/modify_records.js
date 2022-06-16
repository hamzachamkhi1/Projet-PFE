function delete_row(id) {
  if (confirm("Are you sure to remove the room ?")) {
    $.ajax({
      type: "post",
      url: "modify_records.php",
      data: {
        delete_row: "delete_row",
        row_id: id,
      },
      success: function (response) {
        if (response == "success") {
          var row = document.getElementById("row" + id);
          row.parentNode.removeChild(row);
        }
      },
    });
  }
} ;
