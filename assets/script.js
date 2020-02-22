(function () {
    let form = document.querySelector('.lp-search-bar form, .header-filter form');
    if (form!==null) {
        form.onsubmit = function (e) {
            let val = this.querySelector('[name=select]').value;
            if (!val) {
                e.preventDefault();
                this.querySelector('.lp-search-btn').style = '#fff';
                this.querySelector('.searchloading').style.display = "none";
                return false;
            }
            return true;
        }
    }
})();

