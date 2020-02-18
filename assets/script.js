(function () {
    let form = document.querySelector('.lp-search-bar form');
    if (form.length) {
        form.onsubmit = function (e) {
            let val = this.querySelector('[name=select]').value;
            if (!val) {
                e.preventDefault();
                this.querySelector('.lp-search-btn').style.color = '#fff';
                this.querySelector('.searchloading').style.display = "none";
                return false;
            }
            return true;
        }
    }
})();