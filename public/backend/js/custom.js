// const deleteAction = document.querySelectorAll('.post-delete-action');
const tableList = document.querySelector('#dataTable')
const deleteForm = document.querySelector('#delete-form');
if (tableList){
    tableList.addEventListener('click', (e)=>{
        if(e.target.classList.contains('delete-action')){
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "Nếu Xóa Bạn Không Thể Khôi Phục",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteForm.action = e.target.href
                    deleteForm.submit();
                }
            });
        }
    });
}
const getSlug = (title) => {
    let slug = title.toLowerCase().trim(); // Combine the operations

    // Use a map for character replacements for better readability
    const charMap = {
        'á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ': 'a',
        'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ': 'e',
        'i|í|ì|ỉ|ĩ|ị': 'i',
        'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ': 'o',
        'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự': 'u',
        'ý|ỳ|ỷ|ỹ|ỵ': 'u',
        'đ': 'd'
    };

    // Use a loop to iterate over the charMap and apply replacements
    Object.entries(charMap).forEach(([pattern, replacement]) => {
        const regex = new RegExp(pattern, 'gi');
        slug = slug.replace(regex, replacement);
    });

    // Combine multiple replace calls into a single regex
    slug = slug.replace(/[^a-z0-9]+/g, '-');

    // Remove leading and trailing dashes
    slug = slug.replace(/^-+|-+$/g, '');

    return slug;
};

// input name: #title
// input slug: #slug
const slug = document.querySelector('#slug');
if(slug){
    const title = document.querySelector('#title');
    const btnSlug = document.querySelector('#btn-slug')
    let isChangeSlug = false; // nếu đã sửa cái slug rồi thì sẽ theo cái slug đã sửa ấy chứ không theo title
    if (btnSlug){
        btnSlug.addEventListener('click', (e) =>{
            slug.value = getSlug(title.value)
        })
    }
    if (slug.value === ""){
        // chỉ tự thay đổi theo title khi đang ở create
        title.addEventListener("keyup", (e) => {
            if (!isChangeSlug){
                const titleValue = e.target.value;
                slug.value = getSlug(titleValue)
            }
        })

    }
    slug.addEventListener('change', (e) => {
        if (slug.value === ""){
            const title = document.querySelector('#title');
            const titleValue = title.value;
            slug.value = getSlug(titleValue);
        }
        isChangeSlug = true;
    })
}
//unisharp.github.io/laravel-filemanager/integration#standalone-button
$('#lfm').filemanager('image');

const logoutAction = document.querySelector('.logout-action');
const logoutForm = document.querySelector('.logout-form');

if (logoutAction && logoutForm){
    logoutAction.addEventListener('click', (e)=>{
        e.preventDefault();
        logoutForm.action = e.target.href;

        logoutForm.submit();
    })
}
