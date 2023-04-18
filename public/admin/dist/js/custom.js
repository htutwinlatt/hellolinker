

let activeMenu = (mainMenu, subMenu) => {
    setTimeout(() => {
        $(mainMenu).click();
    }, 500);
    $(mainMenu).addClass("active");
    $(subMenu).addClass("active");
};

let loading = () => {
    return `<div class="text-center">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>`;
};

let getDate = (value) => {
    let date = new Date();
    if (value) {
        date = new Date(value);
    }
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    if (day.toString().length < 2) {
        day = '0' + day;
    }
    if (month.toString().length < 2) {
        month = '0' + month;
    }
    if (value) {
        return (day + '-' + month + '-' + year)

    }
    return (year + '-' + month + '-' + day)
}

let subDate = (value) => {
    const today = new Date();
    const date = new Date(today);
    date.setDate(today.getDate() - 5);
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    if (day.toString().length < 2) {
        day = '0' + day;
    }
    if (month.toString().length < 2) {
        month = '0' + month;
    }
    if (value) {
        return (year + '-' + month + '-' + day)

    }
    return (year + '-' + month + '-' + day)
}

$('#epLinkAdd').click(function () {
    let oldValue = $('textArea[name="movieEpisode"]').val();
    let values = oldValue.split('|');
    let newValue = oldValue + 'Episode-'+values.length+' ,' + ' link|'+'\r\n';
    $('textArea[name="movieEpisode"]').val(newValue);
    $('textArea[name="movieEpisode"]').focus()
})


$('.movImageInput').change(function (e) {
    e.preventDefault();
    $('#imageInput').val('');
    let files = this.files;
    let url = URL.createObjectURL(files[0]);
    $('.previewMovImg').attr('src',url)
});

$('#imageInput').change(function(e){
    e.preventDefault();
    $('.previewMovImg').attr('src',$(this).val())
    $('.movImageInput').val('')
})




