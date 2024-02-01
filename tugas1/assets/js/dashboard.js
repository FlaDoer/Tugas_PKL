$(document).ready(function () {
    loadJumlahGuru();
    loadJumlahSiswa();
    loadJumlahAkun();
    loadTabelSiswaKelas();
})

function loadJumlahGuru() {
    let tableBody = $("#jumlahGuru");
    let urlDataPelajaran = siteURL + '/dashboard/jumlah_guru';

     $.ajax({
        type: "POST",
        url: urlDataPelajaran,
        data: "",
        dataType: "JSON",
        success: function (res) {
            if (res.status) {
                let jumlah = '';
                tableBody.empty();
                jumlah += res.data
                jumlahGuru.append(jumlah);
            }
            else
            {
                //data not available
            }
        }
     });
}

function loadJumlahSiswa() {
    let tableBody = $("#jumlahSiswa");
    let urlDataPelajaran = siteURL + '/dashboard/jumlah_siswa';

     $.ajax({
        type: "POST",
        url: urlDataPelajaran,
        data: "",
        dataType: "JSON",
        success: function (res) {
            if (res.status) {
                let jumlah = '';
                tableBody.empty();
                jumlah += res.data
                jumlahSiswa.append(jumlah);
            }
            else
            {
                //data not available
            }
        }
     });
}

function loadJumlahAkun() {
    let tableBody = $("#jumlahAkun");
    let urlDataPelajaran = siteURL + '/dashboard/jumlah_akun';

     $.ajax({
        type: "POST",
        url: urlDataPelajaran,
        data: "",
        dataType: "JSON",
        success: function (res) {
            if (res.status) {
                let jumlah = '';
                tableBody.empty();
                jumlah += res.data
                jumlahAkun.append(jumlah);
            }
            else
            {
                //data not available
            }
        }
     });
}

function loadTabelSiswaKelas() {
    let tableBody = $("#tableBody");
    let url = siteURL + '/dashboard/siswa_per_kelas';

     $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (res) {
            if (res.status) {
                let tbl = '';
                let counter = 1;
                tableBody.empty();
                for (let i in res.data) {
                    tbl += '<tr>'
                        + '<td>' + counter + '</td>'
                        + '<td>' + res.data[i].kelas + '</td>'
                        + '<td>' + res.data[i].jumlah_siswa + '</td>'
                        + '</tr>';
                    counter++;
                }
                tableBody.append(tbl);
            }
            else
            {
                //data not available
            }
        }
     });
}

$(document).ready(function() {
	
chartSiswaKelas = new Chart(document.getElementById("chart"), {
    type: 'bar',
    data: {
    // labels: ["17-25", "26-35", "36-45", "46-55", "56-65",">65"],
        label : [],
        datasets: [
        {
            label: "Siswa",
            //backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#c45870"],
            //data: [50,35,60,25,35,30],
            data: [],
            borderColor:  'rgb(54, 162, 235)',
            backgroundColor: 'rgba(54, 162, 235,0.1)',
            borderWidth: 2,
            borderRadius: 5
        }                   
        ]
        },
        options: {
        legend: { display: false },
        title: {
        display: true,
        text: 'Jumlah Siswa'
        },
        indexAxis: 'y',
        plugins:{
        datalabels:{
        anchor:'end',
        align:'end',
        labels:{
        value:{
        color:'white'
        }
        }
        }
        }
        }
    });
    ajax_SiswaKelas(chartSiswaKelas);
});

function ajax_SiswaKelas(chart, data) {
    let url = siteURL +'/dashboard/chart_siswa_kelas/' ;
//    $.getJSON(url, data).done(function(response) {
//         if (response.status) {
//             chart.data.labels = response.labels;
//             chart.data.datasets[0].data = response.data.jumlah;
                
//             chart.update(); // finally update our chart
//         }
//     });
    $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (response) {
            if (response.status) {
                    chart.data.labels = response.labels;
                    chart.data.datasets[0].data = response.data.jumlah_siswa;
                                
                chart.update(); // finally update our chart
                }
        }
    });
}