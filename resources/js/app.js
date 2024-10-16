/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import moment from 'moment';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import Donut from 'vue-css-donut-chart';
import 'vue-css-donut-chart/dist/vcdonut.css';




/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

app.use(Donut);
app.use(VueSweetalert2);

import MapDashboard from './components/maps/dashboard.vue';
app.component('map-dashboard', MapDashboard);

import MapHistory from './components/maps/history.vue';
app.component('map-history', MapHistory);

import MapDefault from './components/maps/maps.vue';
app.component('map-default', MapDefault);

import MapVoyage from './components/maps/voyage.vue';
app.component('map-voyage', MapVoyage);

import MapBridge from './components/maps/bridge.vue';
app.component('map-bridge', MapBridge);

import SliderSubMenu from './components/slider/submenu.vue';
app.component('slider-submenu', SliderSubMenu);

// import ChartSpeedometer from './components/charts/speedometer.vue';
// app.component('charts-speedometer', ChartSpeedometer);

import ChartFuel from './components/charts/fuel.vue';
app.component('charts-fuel', ChartFuel);

import ChartGraph from './components/charts/graph.vue';
app.component('charts-graph', ChartGraph);

import ChartSpline from './components/charts/spline.vue';
app.component('charts-spline', ChartSpline);

import DateRange from './components/widgets/daterange.vue';
app.component('date-range', DateRange);

// import Speedometer from './components/charts/speedo.vue';
// app.component('speedometer', Speedometer);

// import ChartLine from './components/charts/line.vue';
// app.component('charts-line', ChartLine);

// import WidgetDateRange from './components/widgets/daterange.vue';
// app.component('widget-daterange', WidgetDateRange);

import FleetInformation from './components/fleets/information.vue';
app.component('fleet-information', FleetInformation);

import SideInfo from './components/maps/sideInfo.vue';
app.component('fleet-side-info', SideInfo);

import FleetCargo from './components/fleets/cargo.vue';
app.component('fleet-cargo', FleetCargo);

import FleetBunker from './components/fleets/bunker.vue';
app.component('fleet-bunker', FleetBunker);

import FleetBallast from './components/fleets/ballast.vue';
app.component('fleet-ballast', FleetBallast);

import Compass from './components/charts/compass.vue';
app.component('compass', Compass);

import EngineTypeS from './components/fleets/EngineTypeS.vue';
app.component('engine-type-s', EngineTypeS);

import UserPermission from './components/UserPermission.vue';
app.component('user-permission', UserPermission);

import UserFleet from './components/UserFleets.vue';
app.component('user-fleets', UserFleet);

import TableEditable from './components/widgets/editable.vue';
app.component('table-editable', TableEditable);

import TrendView from './components/charts/trend.vue';
app.component('trend-view', TrendView);

import TrendLive from './components/charts/trend-live.vue';
app.component('trend-live', TrendLive);

import SensorInfo from './components/fleets/sensor-info.vue';
app.component('sensor-info', SensorInfo);

import MimicSvg from './components/fleets/mimic-svg.vue';
app.component('mimic-svg', MimicSvg);

import PDFViewer from './components/pdf.vue';
app.component('pdf-viewer', PDFViewer);

import DataInformation from './components/fleets/table-info.vue';
app.component('data-info', DataInformation);

import MapPinned from './components/maps/pinned.vue';
app.component('map-pinned', MapPinned);

import fleetmimic from './components/fleets/mimic.vue';
app.component('fleet-mimic', fleetmimic);

import svgUpload from './components/fleets/master-svg.vue';
app.component('fleet-svg-upload', svgUpload);

import fileUpload from './components/widgets/file-upload.vue';
app.component('file-upload', fileUpload);

import datatable from './components/fleets/table-history.vue';
app.component('datatable', datatable);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.config.globalProperties.$filters = {
    dateformat(value, format='DD/MM/YYYY HH:mm') {
        let date = moment(value, 'YYYY-MM-DD HH:mm:ss');
        return date.format(format)
    },
    str_limit(value, limit=7) {
        return value.toString().substring(0, limit)
    },
    textFormat(value) {
        let text = value.toLowerCase();
        return text.capitalize()
    },
    number(value, digit = 2) {
        let num = Number.parseFloat(value).toFixed(digit);
        return Number.parseFloat(num).toLocaleString();
    }
}

app.mount('#app');
