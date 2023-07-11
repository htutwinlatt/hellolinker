
$(document).ready(function () {
       //Count Ad close Time
    let countTime = 5;
    let popUpInterval = setInterval(() => {
        $('.countTime').html(countTime--);
        if (countTime == '0') {
            $('.countTime').addClass('d-none');
            $('.closePopUpAdsBottom').removeClass('d-none');
            $('.closePopUpAdsTop').removeClass('d-none');
            clearInterval(popUpInterval);
        }
    }, 1000);

    if (!localStorage.getItem("language")) {
        localStorage.setItem("language", "eng");
    }
    selLanguage();

    $("#languages a").click(function (e) {
        e.preventDefault();
        localStorage.setItem("language",'eng');
        selLanguage();
    });

    $('#vSearchBtn').click(function(){
        Swal.fire({
           title: '<div class="my-5"><i class="fa-solid fa-microphone fs-1 annimateLogo"></i><h2>Say something to search.</h2></div>',
          showConfirmButton: false,
          timer: 6000,
          timerProgressBar: true,
        })
        recognition.start();
    });


    //Read Phone Bill Rule
    $('#billRuleBtn').click(function(){
        Swal.fire({
            title:"<u>စည်းကမ်းသတ်မှတ်ချက်များ</u>",
            html:`
            <ol>
                <li>သတ်မှတ်ထားသော post အား like လုပ်ပြီး public တွင်ရှဲထားရမည်။</li>
                <li>သတ်မှတ်ထားသော post အား facebook group နှစ်ခုတွင် share ထားရမည်။</li>
                <li>Hello Linker Website တ္ငင် အကောင့် ဖွင့် ပါ။ <a href="https://hellolinker.net/register">Sing Up</a></li>
                <li>Share ထားသော Screenshot နှင့် အကောင့်အိုင်ဒီ (သို့) အီးမေးလ် ကို "<b>Hello Linker</b>" Facebook Messenger သို့ ပေးပို့ပြီး ကံစမ်းခွင့်တစ်ကြိမ်ကို ရယူပါ</li>
                <li class="text-danger">အကောင့်တစ်ခုကို တစ်ကြိမ်သာ ကံစမ်းခွင့်ရှိသည်</li>
            </ol>
            `
        })
    })

    // $('.downloadBtnCoverAds').click(function(){
    //     $(this).addClass('d-none')
    // })

});

//Ajax Alert
let Alert = (data) => {
    localStorage.getItem("language") == "mm"
        ? Swal.fire("Success", data.success.mm, "success")
        : Swal.fire("Success", data.success.eng, "success");
};

//Useful Function

let loading = () => {
    return `<div class="d-flex justify-content-center">
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
</div>   `
}

let selLanguage = () => {
    let userChoose = localStorage.getItem("language");
    if (userChoose == "mm") {
        localStorage.setItem("language", "eng");
        $('input[name="searchKey"]').attr("placeholder");
        $('#catSearchInput').attr("placeholder")
    }
    if (userChoose == "eng") {
        $('input[name="searchKey"]').attr("placeholder", "Enter Search");
        $('#catSearchInput').attr("placeholder", "Search Categories")
    }
    $("span[language]").hide();
    $(`span[language="eng"]`).show();
    $(".selLanguage").html($(`a[language=${userChoose}]`).html());
};

let ratingFunction = () => {
    $(".cmtRating").change(function () {
        let val = $(this).val();
        let cls = "border border-4 scaletwo";
        let text = [
            '<span language="eng">bad</span>',
            '<span language="eng">normal</span>',
            '<span language="eng">good</span>',
            '<span language="eng">excellent</span>',
        ];
        $(".ratingIconContainer i").removeClass(cls);
        $(`.ratIcon-${val}`).addClass(cls);
        $.each(text, function (index, text) {
            if (val == index + 1) {
                $("#ratText").html(text);
                selLanguage();
            }
        });
    });

    $(".ratingIconContainer i").click(function () {
        for (let i = 1; i < 5; i++) {
            if ($(this).hasClass("ratIcon-" + i)) {
                $(".cmtRating").val(i).change();
            }
        }
    });
};

function removeDuplicateArray(arr){
    return arr.filter((item,index)=>arr.indexOf(item) == index);
}
