$(document).ready(function () {

  var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true);
  $('#content').css('min-height', height);

  //  CHECK ALL
  $('input[name="checkAll"]').click(function () {
    var status = $(this).prop('checked');
    $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
  });

  // EVENT SIDEBAR MENU
  $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
  var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
  sidebar_menu.on('click', function () {
    if (!$(this).parent('li').hasClass('active')) {
      $('.sub-menu').slideUp();
      $(this).parent('li').find('.sub-menu').slideDown();
      $('#sidebar-menu > .nav-item').removeClass('active');
      $(this).parent('li').addClass('active');
      return false;
    } else {
      $('.sub-menu').slideUp();
      $('#sidebar-menu > .nav-item').removeClass('active');
      return false;
    }
  });
  //handle 
  $(".group-cat").click(function () {
    $('.parent-id').slideToggle("fast");

  })
  $(".parent-id__item").hover(function () {
    $(this).find('.sub-cat').css({ 'display': 'block' }),
      $(this).css({ "background-color": 'green' })
  },

    function () {

      $(this).find('.sub-cat').css("display", "none"),
        $(this).css({ "background-color": 'transparent' })
    }
  )
  $('.parent-id__item .sub-cat .sub-cat__item').hover(function () {
    $(this).css("background-color", "green");

  },
    function () {
      $(this).css("background-color", "transparent");


    })
  $('.parent-id__item .sub-cat .sub-cat__item').click(function () {
    var catId = $(this).attr('data-id');
    var catTitle = $(this).text();
    //    
    $('.group-cat .choose-cat').text(catTitle);

    $("#add_cat_id").val(catId);
  })
  $('.group-thumb .thumb-item').click(function () {
    var id = $(this).attr('data-id');
    $.ajax({
        url : "?mod=product&action=deleteThumb",
        method:"POST",
        data: {id:id},
        dataType:'text',
        error:function (xhr,status,error){
            alert(error);
        }
        
    })

    $(this).remove();
    // set up banner
    

  })

  
  function previewImages() {

    var preview = document.querySelector('.group-thumb');


    if (this.files) {
      [].forEach.call(this.files, readAndPreview);
      // if i execute the test directly, it is seem run before element was created
      // because i dont know how to get Element after it is created ..so..
      setTimeout(test, 10);
    }

    function readAndPreview(file) {

      // Make sure `file.name` matches our extensions criteria
      if (!/\.(jpe?g|png|gif|webp|jfif)$/i.test(file.name)) {
        return alert(file.name + " is not an image");
      }
      
    

      var reader = new FileReader();
      var i = 0;
      reader.addEventListener("load", function () {
        var liItem = document.createElement('li');
        liItem.setAttribute('data-id', i);
        liItem.classList.add("thumb-item");
        liItem.style.backgroundImage = "url(\"" + this.result + "\")";
        preview.appendChild(liItem);
        i++;
      });

      reader.readAsDataURL(file);
    }

  }

  document.querySelector('#upload-thumb').addEventListener("change", previewImages);

  function test() {
    $(".thumb-item").click(function () {
      this.remove();
      removeFile($(this).attr('data-id'));
    })
    
  }
  function removeFile(index) {
    var attachments = document.getElementById("upload-thumb").files; //<-- reference your file input here
    var fileBuffer = new DataTransfer();

    // append the file list to an array iteratively
    for (let i = 0; i < attachments.length; i++) {
      // Exclude file in specified index
      if (index !== i)
        fileBuffer.items.add(attachments[i]);
    }
    document.getElementById('upload-thumb').onchange = null;
    // Assign buffer to file input
    document.getElementById("upload-thumb").files = fileBuffer.files; // <-- according to your file input reference
  }
  //  handle drag to change order slider.
  $("tr").on({
    dragStart: function(event){
      dragStart(event);
    },
    drop: function(event){
      drop(event);
     
    },
    dragover: function(event){
      allowDrop(event);
    }
  })

});
function dragStart(event) {
  event.dataTransfer.setData("Text", event.target.id);
}
function allowDrop(event) {
  event.preventDefault();
}

function drop(event) {
    event.preventDefault();
    var x=event.target.closest("tr");
    var data = event.dataTransfer.getData('Text');
    // var drag = document.getElementById(data);
    // var drop= document.getElementById(x.id);
    var dragchild = document.getElementById(data);
   
    var dropchild = document.getElementById(x.id);
    var contentDrag = dragchild.outerHTML;
    var contentDropp = dropchild.outerHTML;
    var dragSTT = document.querySelector(`#${data} .slider_STT`).innerHTML;
    var dropSTT = document.querySelector(`#${x.id} .slider_STT`).innerHTML;
     var dragOrder = document.querySelector(`#${data} .slider_order`).innerHTML;
     var dropOrder = document.querySelector(`#${x.id} .slider_order`).innerHTML;
     var dragID = dragchild.getAttribute('data-id');
     var dropID = dropchild.getAttribute('data-id');
    
    dragchild.innerHTML= contentDropp;
    dropchild.innerHTML= contentDrag;
   document.querySelector(`#${data} .slider_order`).innerHTML=dragOrder;
   document.querySelector(`#${x.id} .slider_order` ).innerHTML= dropOrder;
   document.querySelector(`#${data} .slider_STT` ).innerHTML= dragSTT;
   document.querySelector(`#${x.id} .slider_STT` ).innerHTML= dropSTT;
   $.ajax({
    url: "?mod=slider&action=handleChangeOrder",
    method:"POST",
    data:{
      dropOrder:dropOrder,
      dragOrder:dragOrder,
        dragID:dragID,
        dropID:dropID,
    },
    dataType:"text",
    success: function (data){

    },
    error:function (xhr,status,error){
      alert(error);
    }
   })

}