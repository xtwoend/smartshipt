<template>
    <div class="ships-records">
        <div class="card">
            <div class="card-header">
                <div class="text-center">
                    <img src="img/singapore.png" alt="" />
                    <div class="text-white">PRO</div>
                </div>
                <div class="w-100 d-flex align-items-start justify-content-between">
                    <div class="card-title">
                        <div>Widuri</div>
                        <small class="text-white">Fleet II</small>
                    </div>
                    <div class="card-status">
                        <div class="status-box bg-online"></div>
                        <div class="text-white">Online</div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div>under way using engine</div>
                <div class="d-flex align-items-center justify-content-between">
                    <div>ATD 27/5</div>
                    <div>ETA 10/6</div>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>Singapura</div>
                    <div>Jakarta</div>
                </div>
                <div class="ships-route-ltr"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

} 
</script>

<style lang="scss" scoped>
.ships-records{
    width: 300px;
    position: absolute;
    z-index: 3;
    top: 100px;
    left: 10px;
    .card {
        background: rgb(0 0 0 / 70%) !important;
        border: none;
        border-radius: 16px;
        .card-header{
            color: #FDD751;
            border: none;
            display: flex;
            align-items: center;
            gap: 1em;
            .card-title{
                text-transform: uppercase;
            }
        }
        .card-status{
            display: flex;
            align-items: center;
            gap: .5em;
            .status-box{
                display: block;
                width: 10px;
                height: 10px;
                border-radius: 20px;
                background: #ddd;
            }
            .bg-online{
                background-color: #12CA19;
                animation: bipbip .5s infinite linear;
            }
        }
        .card-body{
            color: #fff;
        }
    }
    .ships-route-ltr{
        display: block;
        width: 100%;
        height: 2px;
        background: #12CA19;
        position: relative;

        &:after{
            content: "▶︎";
            display: block;
            width: auto;
            height: 18px;
            color: #12CA19;
            position: absolute;
            right: -2px;
            top: -9px;
        }
    }
}
@keyframes bipbip {
  0% {
    background-color: #12CA19;
}
  50% {
    background-color: #149618;
}
  100% {
    background-color: #12CA19;
}
}
</style>