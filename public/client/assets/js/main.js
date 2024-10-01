// Xử lý ckeditor với class
let classTextArea = document.querySelectorAll(".editor");

if (classTextArea !== null) {
  classTextArea.forEach((item, index) => {
    item.id = "editor_" + (index + 1);
    CKEDITOR.replace(item.id);
  });
}

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

var thisPage = 1;
var limitPage = 8;
var listJobItem = $$(".list-job .job-thumb");

function loadJobItem() {
  let beginJobIndex = limitPage * (thisPage - 1);
  let endJobIndex = limitPage * thisPage - 1;

  listJobItem.forEach((item, key) => {
    if (key >= beginJobIndex && key <= endJobIndex) {
      item.style.display = "flex";
    } else {
      item.style.display = "none";
    }
  });
  listPage();
}

loadJobItem();

function listPage() {
  let count = Math.ceil(listJobItem.length / limitPage);
  $(".list-page").innerHTML = "";

  if (thisPage != 1) {
    let prev = document.createElement("li");
    prev.innerText = "Trước";
    prev.setAttribute("onclick", "changePage(" + (thisPage - 1) + ")");
    $(".list-page").appendChild(prev);
  }
  for (let i = 1; i <= count; i++) {
    let newPage = document.createElement("li");
    newPage.innerText = i;
    if (i == thisPage) {
      newPage.classList.add("active");
    }
    newPage.setAttribute("onclick", "changePage(" + i + ")");
    $(".list-page").appendChild(newPage);
  }

  if (thisPage != count) {
    let next = document.createElement("li");
    next.innerText = "Sau";
    next.setAttribute("onclick", "changePage(" + (thisPage + 1) + ")");
    $(".list-page").appendChild(next);
  }
}

function changePage(i) {
  thisPage = i;
  loadJobItem();
}

var btnDetails = $$(".btn-details");
var contentPage = $$(".page-content");
var btnModalClose = $(".btn-close-modal");

btnDetails.forEach((btnDetail, index) => {
  btnDetail.onclick = function () {
    contentPage[index].classList.add("open");
    btnModalClose.onclick = function () {
      contentPage[index].classList.remove("open");
    };
  };
});

const btnNextIndustries = $(".section-key-industries .direction #next");
const btnPrevIndustries = $(".section-key-industries .direction #prev");

btnNextIndustries.onclick = function () {
  const widthItem = $(".industries .item").offsetWidth;
  $(".industries-block").scrollLeft += widthItem;
};

btnPrevIndustries.onclick = function () {
  const widthItem = $(".industries .item").offsetWidth;
  $(".industries-block").scrollLeft -= widthItem;
};

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

function editEmail() {
  const inputEditEmail = document.querySelector('.input-edit-email')
  const btnCancerEdit = document.querySelector('.btn-cancer-edit')
  inputEditEmail.style.display = 'block'
  btnCancerEdit.style.display = 'block'
}

function cancerEditEmail() {
  const inputEditEmail = document.querySelector('.input-edit-email')
  const inputOldEmail = document.querySelector('.old-email')
  const btnCancerEdit = document.querySelector('.btn-cancer-edit')
  inputEditEmail.style.display = 'none'
  inputEditEmail.value = inputOldEmail.value
  btnCancerEdit.style.display = 'none'
}

