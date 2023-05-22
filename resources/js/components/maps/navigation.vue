<template>
    <div class="ships-navigations">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div>Navigation</div>
                </div>
                <div class="card-status">
                    <a href="#">
                        <img src="img/icons/arrow-topright.png" alt="" />
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3 gap-5">
                    <div>
                        <h6 class="m-0">15.015 knots</h6>
                        <small>Speed (Ground)</small>
                    </div>
                    <div>
                        <h6 class="m-0">13.679 knots</h6>
                        <small>Speed (Water)</small>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-3 gap-5">
                    <div>
                        <h6 class="m-0">181.87 deg</h6>
                        <small>Course (Ground)</small>
                    </div>
                    <div>
                        <h6 class="m-0">13.224 knots</h6>
                        <small>Wiind Speed</small>
                    </div>
                </div>
                <div class="ships-route-ltr"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div>Navigation</div>
                </div>
                <div class="card-status">
                    <a href="#">
                        <img src="img/icons/arrow-topright.png" alt="" />
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3 gap-5">
                    <div>
                        <h6 class="m-0">15.015 knots</h6>
                        <small>Speed (Ground)</small>
                    </div>
                    <div>
                        <h6 class="m-0">13.679 knots</h6>
                        <small>Speed (Water)</small>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-3 gap-5">
                    <div>
                        <h6 class="m-0">181.87 deg</h6>
                        <small>Course (Ground)</small>
                    </div>
                    <div>
                        <h6 class="m-0">13.224 knots</h6>
                        <small>Wiind Speed</small>
                    </div>
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
.ships-navigations{
    width: auto;
    top: 100px;
    left: 25%;
    display: flex;
    align-items: center;
    gap: 1em;
    position: absolute;
    z-index: 3;
    // &:before{
    //     content: '';
    //     display: block;
    //     width: 2px;
    //     height: 180px;
    //     background: #fff;
    //     left: -15px;
    //     position: absolute;
    // }
    // &:after{
    //     content: '';
    //     display: block;
    //     width: 2px;
    //     height: 180px;
    //     background: #fff;
    //     right: 0;
    //     position: absolute;
    // }
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
        .card-body{
            color: #fff;
        }
    }
}
</style>