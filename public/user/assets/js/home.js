function showTabContent() {
    const sideBar = document.getElementById('side-bar');
    if (sideBar.classList.contains('d-none')) {
        sideBar.classList.remove('d-none');
    } else {
        sideBar.classList.remove('show');
        sideBar.classList.add('d-none');
    }
}

function openModal() {
    const modalId = `quickViewProductModal`;
    const modal = document.getElementById(modalId);
    modal.style.display = 'block';
    const closeBtn = modal.querySelector('.close');
    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });
}


document.querySelectorAll('.color-btn-filter').forEach(button => {
    button.addEventListener('click', function() {
        if (this.classList.contains('lift-up')) {
            this.classList.remove('lift-up');
        } else {
            this.classList.add('lift-up');
        }
    });
});
document.querySelectorAll('.capacity-btn-filter').forEach(button => {
    button.addEventListener('click', function() {
        if (this.classList.contains('bold-text')) {
            this.classList.remove('bold-text');
        } else {
            this.classList.add('bold-text');
        }
    });
});

document.querySelectorAll('.color-btn').forEach(button => {
    button.addEventListener('click', function() {
        document.querySelectorAll('.color-btn').forEach(btn => btn.classList.remove('lift-up'));
        this.classList.add('lift-up');
    });
});
document.querySelectorAll('.capacity-btn').forEach(button => {
    button.addEventListener('click', function() {
        document.querySelectorAll('.capacity-btn p').forEach(p => p.classList.remove('bold-text'));
        this.querySelector('p').classList.add('bold-text');
    });
});

function increment() {
    var input = document.getElementById('filter-input');
    input.value = parseInt(input.value) + 1;
}

function decrement() {
    var input = document.getElementById('filter-input');
    if (input.value > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

function formatPrice(price) {
    const formattedPrice = new Intl.NumberFormat('vi-VN').format(price);
    return `${formattedPrice}đ`;
}
