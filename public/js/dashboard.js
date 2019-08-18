$.ajax({
    url: '/dashboard/stock/count',
    type: 'GET',
    data: {},
    success: function (count) {
        console.log(count);
        count = count * 100;
        $('.stock-p').width(count.toString() + "%");
        $('.stock').text(Math.round(count) + "%");
    },

    error: function (err) {
        console.log(err);
    }
});


$.ajax({
    url: '/dashboard/orders/count',
    type: 'GET',
    data: {},
    success: function (count) {
        $('.orders').text(count);
    },

    error: function (err) {
        console.log(err);
    }
});


$.ajax({
    url: '/dashboard/stock/earnings',
    type: 'GET',
    data: {},
    success: function (amount) {
        console.log(amount);
        $('.earning').text("$" + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    },

    error: function (err) {
        console.log(err);
    }
});

$.ajax({
    url: '/dashboard/stock/sales',
    type: 'GET',
    data: {},
    success: function (sales) {
        console.log(sales);
        $('.sales').text(sales);
    },

    error: function (err) {
        console.log(err);
    }
});


// var stock=50;
//
// $('.earning').text('50,000');
// $('.stock').text(stock+'%');
//
// $('.stock-p').width = width;