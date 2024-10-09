<script>
    let currentPage = {{ $paginator->currentPage }}
    let totalPages = {{ $paginator->totalPages }}
    const paginationBtns = document.querySelectorAll('.pagination-btn');

    paginationBtns.forEach( (btn) => {
        btn.addEventListener( 'click', function () {

            if (this.classList.contains('prev')) {
                if (currentPage > 1) {
                    currentPage--;
                }
            } else if (this.classList.contains('next')) {
                currentPage++; 
            } else {
                currentPage = parseInt(this.dataset.page); 
            }
            updatePrevBtn();
            updateNextBtn();
            let url = '{{ route("user.product.saleLimited") }}?page=' + currentPage;
            window.location.href = url;
        })
    });

    function updatePrevBtn() {
        if (document.querySelector('.pagination-btn.prev')){
            if (currentPage == 1) {
                document.querySelector('.pagination-btn.prev').disabled = true;
            }
            else {
                document.querySelector('.pagination-btn.prev').disabled = false;
            }
        }
    }
    updatePrevBtn()
    function updateNextBtn() {
        if (document.querySelector('.pagination-btn.next')) {
            if (currentPage == totalPages) {
                document.querySelector('.pagination-btn.next').disabled = true;
            }
            else {
                document.querySelector('.pagination-btn.next').disabled = false;
            }
        }
    }
    updateNextBtn()
</script>