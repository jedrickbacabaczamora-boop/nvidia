<style>
    .van-toast {
        position: fixed;
        top: 50%;
        left: 50%;
        display: -webkit-box;
        display: -webkit-flex;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        flex-direction: column;
        -webkit-box-align: center;
        -webkit-align-items: center;
        align-items: center;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        box-sizing: content-box;
        width: 85px;
        max-width: 70%;
        min-height: 1.51724rem;
        padding: .27586rem;
        color: #fff;
        font-size: .24138rem;
        white-space: pre-wrap;
        text-align: center;
        word-break: break-all;
        background-color: rgba(0,0,0,.7) !important;
        border-radius: .13793rem;
        -webkit-transform: translate3d(-50%,-50%,0);
        transform: translate3d(-50%,-50%,0);
        transition: .4s;
        z-index: -1;
        opacity: 0;
    }

    .gig_box {
        position: fixed;
        top: 50%;
        left: 50%;
        display: -webkit-box;
        display: -webkit-flex;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        flex-direction: column;
        -webkit-box-align: center;
        -webkit-align-items: center;
        align-items: center;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        box-sizing: content-box;
        width: 85px;
        max-width: 70%;
        min-height: 1.51724rem;
        padding: .27586rem;
        color: #fff;
        font-size: .24138rem;
        white-space: pre-wrap;
        text-align: center;
        word-break: break-all;
        background-color: rgba(0,0,0,.7) !important;
        border-radius: .13793rem;
        -webkit-transform: translate3d(-50%,-50%,0);
        transform: translate3d(-50%,-50%,0);
        transition: .4s;
        z-index: -1;
        opacity: 0;
    }
    .gig_box .gif {
        width: 20px !important;
    }
</style>

<div class="gig_box" id="preLoad">
    <img src="{{asset('public/loading.gif')}}" class="gif" alt="loading">
</div>

<div class="van-toast van-toast middle van-toast success" id="msg" style=""><i
        class="van-icon van-icon-success van-toast__icon"></i>
    <div class="van-toast__text">Message</div>
</div>

<script>
    function loading(){
        document.getElementById('preLoad').style.zIndex = '2001';
        document.getElementById('preLoad').style.opacity = '1';
    }

    function loadingOff(){
        document.getElementById('preLoad').style.zIndex = '-1';
        document.getElementById('preLoad').style.opacity = '0';
    }

    function msg(msgText){
        document.getElementById('msg').style.zIndex = '2001';
        document.getElementById('msg').style.opacity = '1';

        document.querySelector('.van-toast__text').innerHTML = msgText;
    }

    function msgOff(){
        document.getElementById('msg').style.zIndex = '-1';
        document.getElementById('msg').style.opacity = '0';
    }
</script>


