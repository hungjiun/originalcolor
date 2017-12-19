<script type="text/javascript">
    function customPager( total, limit, length, container, selector, btn_color){
        return {
            container : container,
            selector : selector,
            optionMaxCount : Math.ceil( total / limit ),
            optionLength : length,
            currentPage : 1,
            rdFirstPageNum : null,

            createPager : createPager,
            setPage : setPage,

            btn_color: btn_color!=null?btn_color:'#dd3131'
        };
    }
    function createPager(){
        $(this.container).find(this.selector).find("li.page-option").remove();
        //增加頁數連結
        var html_page_option_str = '<li class="page-option"><a href="#">1</a></li>';
        for (i = 1; i < this.optionMaxCount - this.rdFirstPageNum + 1 && i < this.optionLength; i++) {
            html_page_option_str += '<li class="page-option"><a href="#">1</a></li>';
        }
        $(this.container).find(this.selector).append(html_page_option_str);
        //填入頁數連結屬性
        for (i = 0; i < this.optionMaxCount - this.rdFirstPageNum + 1 && i < this.optionLength; i++) {
            $(this.container).find(this.selector).find("li.page-option").find("a")[i].text = (parseInt(this.rdFirstPageNum) + i);
            $(this.container).find(this.selector).find("li.page-option").find("a")[i].href = 'javascript:getPageList(' + ( parseInt(this.rdFirstPageNum) + i ) + ')';
            if ( ( parseInt(this.rdFirstPageNum) + i ) === this.currentPage) {
                //點擊的連結樣式
                $(this.container).find(this.selector).find("li.page-option").find("a")[i].style = 'color : #ffffff; background-Color : '+this.btn_color+';';
            }
        }
    }
    function setPage(page){
        this.currentPage = page;
        //導向目的頁面的第一個option的數字 將當前頁面頁碼至於中間或中間-1
        this.rdFirstPageNum = page - Math.ceil(this.optionLength / 2) + 1;
        if (this.rdFirstPageNum < 1) {
            this.rdFirstPageNum = 1;
        }
        else if (this.optionMaxCount - this.rdFirstPageNum < this.optionLength - 1) {
            this.rdFirstPageNum = this.optionMaxCount - ( this.optionLength - 1);
            if (this.rdFirstPageNum < 1) {
                this.rdFirstPageNum = 1;
            }
        }
        this.createPager();

        //上下頁設定
        if(parseInt(page-1) > 0)
            $(this.container).find(this.selector).parent().find("li.previous").find("a")[0].href = 'javascript:getPageList(' + parseInt(page-1)  + ')';
        if(parseInt(page+1) <= this.optionMaxCount)
            $(this.container).find(this.selector).parent().find("li.next").find("a")[0].href = 'javascript:getPageList(' + parseInt(page+1)  + ')';
    }
</script>