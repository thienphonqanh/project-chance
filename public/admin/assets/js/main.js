// Chuyển đổi title -> slug
function toSlug(title) {
  let slug = title.toLowerCase(); //Chuyển thành chữ thường

  slug = slug.trim(); //Xoá khoảng trắng 2 đầu

  //lọc dấu
  slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, "a");
  slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, "e");
  slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, "i");
  slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, "o");
  slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, "u");
  slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, "u");
  slug = slug.replace(/đ/gi, "d");

  //chuyển dấu cách (khoảng trắng) thành gạch ngang
  slug = slug.replace(/ /gi, "-");

  //Xoá tất cả các ký tự đặc biệt
  slug = slug.replace(
    /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
    ""
  );

  return slug;
}

let sourceTitle = document.querySelector(".slug");
let slugRender = document.querySelector(".render-slug");

if (sourceTitle !== null && slugRender !== null) {
  sourceTitle.addEventListener("keyup", (e) => {
    if (!sessionStorage.getItem("save_slug")) {
      let title = e.target.value;

      if (title !== null) {
        let slug = toSlug(title);

        slugRender.value = slug;
      }
    }
  });

  sourceTitle.addEventListener("change", () => {
    sessionStorage.setItem("save_slug", 1);
  });

  slugRender.addEventListener("change", (e) => {
    let slugValue = e.target.value;
    if (slugValue.trim() == "") {
      sessionStorage.removeItem("save_slug");
      let slug = toSlug(sourceTitle.value);
      e.target.value = slug;
    }
  });

  if (slugRender.value.trim() == "") {
    sessionStorage.removeItem("save_slug");
  }
}

// Xử lý ckeditor với class
let classTextArea = document.querySelectorAll(".editor");

if (classTextArea !== null) {
  classTextArea.forEach((item, index) => {
    item.id = "editor_" + (index + 1);
    CKEDITOR.replace(item.id);
  });
}

function loadMainCategories() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", rootUrl + "/admin/handbook/getCategory", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var mainCategories = JSON.parse(xhr.responseText);
      var mainCategoryDropdown = document.getElementById("mainCategory");

      mainCategories.forEach(function (category) {
        var option = document.createElement("option");
        option.value = category.id;
        option.text = category.name;
        mainCategoryDropdown.add(option);
      });

      // Gọi hàm để load danh sách danh mục phụ cho danh mục chính đầu tiên
      loadSubCategories();
    }
  };
  xhr.send();
}

function loadSubCategories() {
  var mainCategoryId = document.getElementById("mainCategory").value;
  var subCategoryDropdown = document.getElementById("subCategory");

  if (mainCategoryId == "0") {
    subCategoryDropdown.innerHTML = "";

    var defaultOptionSub = document.createElement("option");
    defaultOptionSub.value = "0";
    defaultOptionSub.text = "Chọn danh mục";
    subCategoryDropdown.add(defaultOptionSub);
    subCategoryDropdown.disabled = true;
  } else {
    subCategoryDropdown.disabled = false;
  }

  var xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    rootUrl + "/admin/handbook/getSubCategory?category=" + mainCategoryId,
    true
  );
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var subCategories = JSON.parse(xhr.responseText);

      // Xóa tất cả các option cũ trong dropdown danh mục phụ
      subCategoryDropdown.innerHTML = "";

      subCategories.forEach(function (category) {
        var option = document.createElement("option");
        option.value = category.id;
        option.text = category.name;
        subCategoryDropdown.add(option);
      });
    }
  };
  xhr.send();
}
var subCategoryDropdown = document.getElementById("subCategory");

if (subCategoryDropdown != null && subCategoryDropdown.value == 0) {
  // Gọi hàm để load danh sách danh mục chính khi trang được tải
  loadMainCategories();
}

// Xử lý chọn checkbox và button xoá
var selectAllCheckbox = document.querySelector(".checkbox-select-all");
var checkboxes = document.querySelectorAll(".checkbox-item");
var deleteButton = document.querySelector(".delete-button");

// Thiết lập nút chọn tất cả của checkbox
selectAllCheckbox.addEventListener("change", function () {
  var count = 0;
  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = selectAllCheckbox.checked;
  }

  // Thiết lập button enable với nút chọn tất cả checkbox
  if (selectAllCheckbox.checked) {
    count = checkboxes.length;
    deleteButton.removeAttribute("disabled");
  } else {
    count = 0;
    deleteButton.setAttribute("disabled", "disabled");
  }

  deleteButton.innerHTML = `Xoá đã chọn (${count})`;
});

for (var i = 0; i < checkboxes.length; i++) {
  checkboxes[i].addEventListener("change", function () {
    var atLeastOneChecked = false;
    for (var j = 0; j < checkboxes.length; j++) {
      if (checkboxes[j].checked) {
        atLeastOneChecked = true;
        break;
      }
    }

    // Xử lý button enable khi chọn ít nhất 1 checkbox
    if (atLeastOneChecked) {
      deleteButton.removeAttribute("disabled");
    } else {
      deleteButton.setAttribute("disabled", "disabled");
    }
  });
}

for (var i = 0; i < checkboxes.length; i++) {
  checkboxes[i].addEventListener("change", function () {
    var count = 0;
    for (var j = 0; j < checkboxes.length; j++) {
      if (checkboxes[j].checked) {
        count++;
      }
    }
    deleteButton.innerHTML = `Xoá đã chọn (${count})`;
  });
}

// Hàm hiển thị ảnh xem trước
function previewImage() {
  var fileInput = document.getElementById("avatar-input");
  var preview = document.getElementById("avatar-preview");

  // Xóa tất cả các phần tử con trong phần hiển thị trước khi thêm mới
  while (preview.firstChild) {
    preview.removeChild(preview.firstChild);
  }

  var files = fileInput.files;
  for (var i = 0; i < files.length; i++) {
    var file = files[i];
    var reader = new FileReader();

    reader.onload = function (e) {
      var img = document.createElement("img");
      img.src = e.target.result;
      img.style.width = "120px";
      img.style.height = "120px";
      preview.appendChild(img);
    };

    reader.readAsDataURL(file);
  }

  // Ẩn hoặc xoá ảnh mặc định
  var defaultAvatar = document.getElementById("avatar-default");
  if (defaultAvatar) {
    defaultAvatar.style.display = "none";
  }
}

// Hàm xoá ảnh đã chọn
function deleteImage(thumbnail) {
  var preview = document.getElementById("avatar-preview");
  var deleteInput = document.getElementById("delete-image");

  deleteInput.style.display = "block";
  deleteInput.type = "hidden";
  deleteInput.name = "delete-image";
  deleteInput.value = "delete-image-value";

  // Xóa tất cả các phần tử con trong phần hiển thị trước khi thêm mới
  while (preview.firstChild) {
    preview.removeChild(preview.firstChild);
  }

  // Thêm ảnh mặc định vào phần hiển thị
  var defaultImg = document.createElement("img");
  defaultImg.src = rootUrl + "/public/client/assets/images/" + thumbnail; // Đặt đường dẫn của ảnh mặc định
  defaultImg.style.width = "130px";
  defaultImg.style.height = "130px";
  preview.appendChild(defaultImg);
}


function validateFile() {
  const fileInput = document.getElementById('upload-cv');
  const fileNameDisplay = document.getElementById('file-name');
  const errorMessage = document.getElementById('error-message');
  const deleteButton = document.getElementById('delete-button-cv');

  if (fileInput.files.length > 0) {
      const allowedFormats = [".pdf", ".doc", ".docx"];
      const fileExtension = fileInput.files[0].name.split('.').pop().toLowerCase();

      if (allowedFormats.indexOf(`.${fileExtension}`) === -1) {
          // Display error message
          errorMessage.innerText = 'Chỉ chấp nhận file có định dạng .PDF, .DOC, hoặc .DOCX.';

          // Reset file input and clear file name display
          fileInput.value = '';
          fileNameDisplay.innerText = '';
          fileNameDisplay.classList.remove('border', 'border-1', 'border-secondary');
          deleteButton.style.display = 'none'
      } else {
          // Clear error message
          errorMessage.innerText = '';

          // Display file name
          fileNameDisplay.innerText = `${fileInput.files[0].name}`;
          fileNameDisplay.classList.add('border', 'border-1', 'border-secondary');
          deleteButton.style.display = 'inline-block'
      }

  }
}

function deleteFile() {
  const fileInput = document.getElementById('upload-cv');
  const fileNameDisplay = document.getElementById('file-name');
  const deleteButton = document.getElementById('delete-button-cv');

  fileInput.value = '';
  fileNameDisplay.innerText = '';
  fileNameDisplay.classList.remove('border', 'border-1', 'border-secondary');
  deleteButton.style.display = 'none';
}