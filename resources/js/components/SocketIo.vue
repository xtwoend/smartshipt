<template>
    <div>
        {{  data }}
        {{ connected }}
    </div>
</template>

<script>
export default {
    props: {
        url: String,
        event: String,
        fleet: Object
    },
    data () {
        return {
            socket: null,
            connected: false,
            data: null
        }
    },
    mounted () {
        this.socket = io('ws://127.0.0.1:9502', {transports: ["websocket"] });
        this.socket.on('connect', () => this.connected = true);
        this.socket.on('disconnect', () => this.connected = false);
        this.socket.emit('subscribe', `fleet-${this.fleet.id}`);
        this.socket.on(this.event, this.onMessage);
    },
    methods: {
        onMessage(e) {
            this.data = e
        }
    }
}
</script>

<style lang="scss" scoped>

</style>