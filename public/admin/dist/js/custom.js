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
    if (value) {
        return(day+'-'+month+'-'+year)

    }
    return(year+'-'+month+'-'+day)
}

let subDate = (value) => {
    let date = new Date();
    let day = date.getDate()-value;
    let minDay = day
    let month = date.getMonth() + 1;
    let minMonth = month
    let year = date.getFullYear();
    if (day.toString().length < 2) {
        minDay = '0'+day;
    }
    if (month.toString().length < 2) {
        minMonth = '0'+month;
    }
    return(year+'-'+minMonth+'-'+minDay)
}

$('#epLinkAdd').click(function(){
    let oldValue = $('textArea[name="movieEpisode"]').val();
    let newValue = oldValue+'Episode- ,'+' link|';
    $('textArea[name="movieEpisode"]').val(newValue);
    $('textArea[name="movieEpisode"]').focus()
})

