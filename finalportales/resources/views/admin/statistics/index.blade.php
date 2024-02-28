@extends('layouts.admin')

@section('title','Estadísticas')

@section('main')
<script src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="row py-4 bg-light deleteRowMargin">
        <div class="col-12 text-center">
            <h1>Estadísticas</h1>
        </div>
    </div>
    <div class="row m-3 justify-content-center">
            <div class="col-8">
                <a class="btn btn-dark my-3 text-white" href="<?= url('admin/dashboard');?>">Volver al panel</a>
            </div>
        <div class="col-md-12 d-flex justify-content-center">
            <p class="text-center small text-info"> Seleccione alguna de las siguientes estadísticas para ver el grafico asociado.</p>
        </div>
        <div class="col-md-8 mx-auto">
            <form action="{{ route('admin.statistics.get') }}" method="post" class="d-flex align-items-center" id="statisticsForm">
                @csrf
                <select class="form-control mx-2" id="chartTypes" name="chartTypeId">
                @foreach($chartTypes ?? [] as $chartTypeId => $chartTypeName)
                    <option value="{{ $chartTypeId }}">{{ $chartTypeName }}</option>
                @endforeach
                </select>
                <!-- <button type="submit" class="btn btn-primary">Buscar</button> -->
            </form>
        </div>
    </div>
@if($data != null)
    <div class="row justify-content-center  deleteRowMargin">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-body">
                    <h2>{{$title}}</h2>
                    <div class="container">
                        @if($selectedChartType == 1)
                            <div
                                id="chart-1"
                                style="max-width:1200px; height:450px;">
                            </div>
                        @endif
                        @if($selectedChartType == 2)
                        <div
                            id="chart-2"
                            style="max-width:1200px; height:450px;">
                        </div>
                        @endif
                        @if($selectedChartType == 3)
                        <div
                            id="chart-3"
                            style="max-width:1200px; height:450px;">
                        </div>
                        @endif
                        @if($selectedChartType == 4)
                        <div
                            id="chart-4"
                            style="max-width:1200px; height:450px;">
                        </div>
                        @endif
                        @if($selectedChartType == 5)
                        <div
                            id="chart-5"
                            style="max-width:1200px; height:450px;">
                        </div>
                        @endif
                        @if($selectedChartType == 6)
                        <div
                            id="chart-6"
                            style="max-width:1200px; height:450px;">
                        </div>
                        @endif
                        @if($selectedChartType == 7)
                        <div
                            id="chart-7"
                            style="max-width:1200px; height:450px;">
                        </div>
                        @endif
                        @if($selectedChartType == 8)
                        <div
                            id="chart-8"
                            style="max-width:1200px; height:450px;">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row justify-content-center  deleteRowMargin">
        <div class="col-md-8">
            <p class="text-center">NO HAY DATOS PARA MOSTRAR ESTADíSTICA</p>
        </div>
    </div>
@endif
   <script>
    // SCRIPTS PARA SELECTBOX Y SETEO DE TIPO DE CHART
    const chartTypesSelect = document.getElementById("chartTypes");
        const chartTypes = [
            { key: 1, value: 'Cantidad total vendida por producto' },
            { key: 2, value: 'Cantidad total de productos comprados por usuario' },
            { key: 3, value: 'Liquidacion total por producto' },
            { key: 4, value: 'Liquidacion total por usuario' },
            { key: 5, value: 'Pedidos finalizados por usuario' },
            { key: 6, value: 'Productos por categoria' },
            { key: 7, value: 'Liquidacion por categoria' },
        ];
        // cargo los nombres de los option del selectbox para Estadística
        for (const { key, value } of chartTypes) {
        const optionElement = document.createElement("option");
            optionElement.value = key;
            optionElement.textContent = value;
            chartTypesSelect.appendChild(optionElement);
        }
        // seteo selectBox con chartTypeSelected enviado del back
        const sc = <?php echo json_encode($selectedChartType); ?>;
        if (sc) {
            chartTypesSelect.value = sc;
        }
        // SCRIPTS PARA GOOGLE CHARTS
        google.charts.load('current', {'packages':['{{$packages}}']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            const selectedChartType = <?php echo json_encode($selectedChartType); ?>;
            if(selectedChartType != 0){
                const chartData = getChartData();
                // const chartOptions = getChartOptions(selectedChartType);
                const chartDivId = `chart-${selectedChartType}`;
                const chart = createChartInstance(chartDivId, selectedChartType);
                const options = {
                    title:'',
                    // pieHole: 0.2,
                    // title:'{{$title}}'
                };

                chart.draw(chartData, options);
            }
        }
        function getChartData(){
            const jsonData = <?php echo json_encode($data); ?>;
            const transformedArray = transformJsonData(jsonData);
            return google.visualization.arrayToDataTable(transformedArray);
        }
        function createChartInstance(chartDivId, selectedChartType) {
            switch (selectedChartType) {
                case 1:
                    return new google.visualization.BarChart(document.getElementById(chartDivId));
                case 2:
                    return new google.visualization.BarChart(document.getElementById(chartDivId));
                case 3:
                    return new google.visualization.BarChart(document.getElementById(chartDivId));
                case 4:
                    return new google.visualization.PieChart(document.getElementById(chartDivId));
                case 5:
                    return new google.visualization.PieChart(document.getElementById(chartDivId));
                case 6:
                    return new google.visualization.BarChart(document.getElementById(chartDivId));
                case 7:
                    return new google.visualization.PieChart(document.getElementById(chartDivId));
                
                default:
                    console.warn(`Unknown chart type: ${chartTypeId}`);
                    return new google.visualization.PieChart(document.getElementById(chartDivId));
            }
        }
        function transformJsonData(jsonData) {
            const jsonHeadersChart = <?php echo json_encode($headersChart); ?>;
            const transformedData =  [jsonHeadersChart];
            for (const [key, value] of Object.entries(jsonData)) {
                if (key === jsonHeadersChart[0]) {
                continue;
                }
                transformedData.push([key, value]);
            }
            return transformedData;
        }

        chartTypesSelect.addEventListener("change", function() {
            const form = document.getElementById("statisticsForm");
            form.submit();
        });

        // Ejemplo de chart temporal para v3 si llego.
        // function drawChart() {
        //     console.log(selectedChartType ?? 1);
        // // Some raw data (not necessarily accurate)
        // var data = google.visualization.arrayToDataTable([
        //   ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
        //   ['2021/05',  165,      938,         522,             998,           450,      614.6],
        //   ['2022/06',  135,      1120,        599,             1268,          288,      682],
        //   ['2023/07',  157,      1167,        587,             807,           397,      623],
        //   ['2024/08',  139,      1110,        615,             968,           215,      609.4],
        // //   ['2025/09',  136,      691,         629,             1026,          366,      569.6]
        //   ]);

        //  var options = {
        //   title : 'Monthly Coffee Production by Country',
        //   vAxis: {title: 'Cups'},
        //   hAxis: {title: 'Month'},
        //   seriesType: 'bars',
        //   series: {5: {type: 'line'}}
        // };

        //     var chart = new google.visualization.ComboChart(document.getElementById('myChart'));
        //     chart.draw(data, options);
        //   }
    </script>
@endsection
@section('javascript')

@endsection