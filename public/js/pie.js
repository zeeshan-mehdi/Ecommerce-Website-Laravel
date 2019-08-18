
//url '/dashboard/products/categories'


$.ajax({
    url: '/dashboard/products/categories',
    type: 'GET',
    data: {},
    success: function (resp) {

        //console.log(resp);
        var categories  =[];
        var data = [];

        var jsobj = JSON.parse(resp);

        for(let item in jsobj){
            categories.push(jsobj[item]['category']);
            data.push(jsobj[item]['count']);
        }

        if(data.length>3) {
            sortedData = findLargest3(data);
            topCategories = [];
            topValues=[]
            let i=0;
            for(i=0;i<3;i++){
                for(let item in jsobj){
                    if(sortedData[i]==jsobj[item]['count']){
                        topCategories.push(categories.push(jsobj[item]['category']));
                        topValues.push(sortedData[i]);
                        var html = $('.lbl'+i).html();
                        $('.lbl'+i).html(html+jsobj[item]['category']);
                        break;
                    }
                }
            }
            data = topValues;
            categories = topCategories;

        }else{
            for(let i=0;i<categories.length;i++){
                var html = $('.lbl'+i).html();
                $('.lbl'+i).html(html+categories[i]);
            }
        }

        console.log(categories);
        console.log(data);

        execute(categories,data);

    },

    error: function (err) {
        console.log(err);
    }
});

function findLargest3(data){
    // sort descending
    data.sort(function(a,b) {
        if (a < b) { return 1; }
        else if (a === b) { return 0; }
        else { return -1; }
    });

    return data;


    //alert(data+"/******/"+scoreByPattern[0]+"/"+scoreByPattern[1]+"/"+scoreByPattern[2]);
}


function execute(categories,data){
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: categories,
            datasets: [{
                data: data,
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
}


