$(document).ready(function() {
    $('#pageWrapper .scroller').baron({
        bar: '.scroller__bar',
        barOnCls: 'baron',
        pause: 0.1
    }).controls({
        track: '.scroller__track-visual',
        forward: '.scroller__up',
        backward: '.scroller__down',
        screen: 0.5,
        delta: 60
    });
});