"use strict";
function showStatusMessage(status, title, message) {
    Swal.fire({
      icon: status,
      title:`<div class="swal2-message-${status}">${title}</div>`,
      html: `<div class="swal2-message-${status}">${message}</div>`,
      confirmButtonText: 'OK',
       timer: 2000,
    });
  }
  
  function showCancelMessage(url) {
    Swal.fire({
      title: "Are you sure ?",
      text: "The data you entered can not be saved !",
      icon: "warning",
      color:"red",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes!",
      cancelButtonText: "No!",
  }).then((result) => {
      if (result.isConfirmed) {
          window.location.href = url;
      }
  });
  }
  
  function showDeleteMessage(url) {
    Swal.fire({
      title: "Are you sure you want to delete ?",
      icon: "warning",
      color:"red",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Delete",
      cancelButtonText: "Cancel",
  }).then((result) => {
      if (result.isConfirmed) {
          window.location.href = url;
      }
  });
  }
  
  function showValidationMessage(message) {
    Swal.fire({
      // icon: 'error',
      title: 'Validation Error',
      html: `<div class="swal2-validation-message" style="color: red;">${message}</div>`,
      confirmButtonText: 'OK',
  
    });
  }