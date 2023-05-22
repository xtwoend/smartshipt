<template>
    <div class="ships-cctv">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div>Bridge</div>
                </div>
                <div class="card-status">
                    <a href="#">
                        <img src="img/icons/fullscreen.png" alt="" />
                        Fullscreen
                    </a>
                    <a href="#">
                        Esc to exit
                    </a>
                </div>
            </div>
            <div class="card-body">
                <img src="img/image-1.png" alt="" class="w-100" />
            </div>
        </div>
    </div>
</template>

<script>
export default {

} 
</script>

<style lang="scss" scoped>
.ships-cctv {
    width: 60%;
    top: 320px;
    left: 20%;
    bottom: 16%;
    transition: 0.3s;
    z-index: 3;
    position: absolute;
    .card {
        background: rgb(0 0 0 / 70%) !important;
        border: none;
        border-radius: 16px;
        .card-header{
            color: #FDD751;
            border: none;
            display: flex;
            align-items: center;
            justify-content: space-between;

            .card-title{
                text-transform: uppercase;
            }
        }
        .card-status{
            display: flex;
            align-items: center;
            gap: 2em;
            a{
                color: #fff;
                display: flex;
                align-items: center;
                gap: .5em;
            }
        }
        .card-body{
            color: #fff;
            max-height: calc(100vh - 450px);
            overflow-y: auto;
        }
    }

}
</style>