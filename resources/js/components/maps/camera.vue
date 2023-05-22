<template>
    <div class="ships-camera">
        <a href="">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div>Front View</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center flex-column gap-1">
                        <img src="img/icons/camera.png" alt="" />
                        <small>Camera</small>
                    </div>
                </div>
            </div>
        </a>
        <a href="">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div>Bridge</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center flex-column gap-1">
                        <img src="img/icons/camera.png" alt="" />
                        <small>Camera</small>
                    </div>
                </div>
            </div>
        </a>
    </div>
</template>

<script>
export default {

} 
</script>

<style lang="scss" scoped>
.ships-camera{
    width: auto;
    height: 200px;
    top: 100px;
    right: 10px;
    display: flex;
    align-items: center;
    gap: 1em;
    position: absolute;
    z-index: 3;
    a{
        height: 100%;
    }
    .card {
        background: rgb(0 0 0 / 70%) !important;
        border: none;
        border-radius: 16px;
        height: 100%;
        width: 200px;
        .card-header{
            color: #FDD751;
            border: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            .card-title{
                text-transform: uppercase;
            }
        }        .card-body{
            color: #fff;
        }
    }
}
</style>