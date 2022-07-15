
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Laporan Bagan Pendapatan Perbulan</title>
</head>
<body>
    <div class="content">

      <div class="container-fluid">
        <div class="text-center">
            <h3>Laporan Pendapatan Perbulan Tahun {{date("Y");}}</h3>
        </div>
        <div style="padding: 12px;" class="row">
            <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Bulan</th>
                    <th class="text-center">Pendapatan</th>
                 
                  </tr>
                </thead>
               
                <tbody>
                    @php
                    $month = [
                        "Januari",
                        "Februari",
                        "Maret",
                        "April",
                        "Mei",
                        "Juni",
                        "Juli",
                        "Agustus",
                        "September",
                        "Oktober",
                        "November",
                        "Desember"
                    ];
                    
                    @endphp
                  @foreach($data as $order)  
                      <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="text-center">{{$month[$loop->iteration -1 ]}}</td>
                        <td class="text-center">Rp. {{number_format($order,2)}}</td>
                       
                      </tr>  

                  @endforeach
                </tbody>
              </table>
        </div>
    
      </div>
      
    </div>
    
</body>

</html>
