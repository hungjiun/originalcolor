//==================== loading對應 ============================================================

function showLoading(boo){    // boo為true，開啟loading畫面 ================
    if(boo){
        $('.loadingCube').css({"display":"block"});
    }else{
        $('.loadingCube').css({"display":"none"});
    }
}