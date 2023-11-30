// const deleteAction = document.querySelectorAll('.post-delete-action');
const tableList = document.querySelector('#dataTable')
const deleteForm = document.querySelector('#delete-form');
tableList.addEventListener('click', (e)=>{
    if(e.target.classList.contains('post-delete-action')){
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
