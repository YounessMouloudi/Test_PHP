<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('css/gestion.css')}}">
</head>
<body class="bg-body-tertiary">
    <div class="container py-5">
        @if (session('success'))
            <div class="alert alert-success fw-semibold" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex gap-3">
            <a href="{{ route("home")}}" class="mt-1 fw-semibold fs-5 text-primary">\Home</a>
            <h3 class="fw-bold mb-5">Listes des témoignages</h3>
        </div>
        <table class="table table-bordered table-hover text-center">
            <thead class="text-capitalize">
                <tr>
                    <th>#ID</th>
                    <th>titre</th>
                    <th>date</th>
                    <th>statut</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($temoignages->isNotEmpty())
                    @foreach ($temoignages as $tem)
                        <tr class="fw-semibold" draggable="true" ondragstart="drag(event)" ondragover="allowDrop(event)" ondrop="drop(event)">
                            <td data-id="{{$tem->id}}">{{$tem->id}}</td> 
                            <td>{{$tem->titre}}</td> 
                            <td>{{$tem->created_at->format("d-m-Y")}}</td> 
                            <td><span class="badge p-2 {{ $tem->statut === 'approuvé' ? 'bg-success' : ($tem->statut === 'en attente' ? 'bg-primary' : 'bg-danger') }}">{{$tem->statut}}</span></td> 
                            <td>
                                <a href="{{ route("edit_temoignage",$tem->id)}}" class="btn btn-primary text-capitalize">edit</a>
                            </td> 
                        </tr>
                    @endforeach                    
                @else
                    <tr>
                        <td colspan="5" class="text-capitalize fw-bold text-danger">aucun témoignage trouvé</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <script>
        var dragItem;

        function drag(event) {
            dragItem = event.target;
            event.dataTransfer.effectAllowed = "move";
            event.dataTransfer.setData("text/html",dragItem.outerHTML);
        }

        function allowDrop(event) {
            event.preventDefault();
        }

        function drop(event) {
            event.preventDefault();
            var targetTr = event.target.closest("tr");
            var tableBody = document.querySelector("tbody");
            var tableRows = Array.from(tableBody.querySelectorAll("tr"));
            var dragIndex = tableRows.indexOf(dragItem);
            var targetIndex = tableRows.indexOf(targetTr);

            if(dragIndex !== -1 && targetIndex !== -1) {
                var start = Math.min(dragIndex,targetIndex);
                var end = Math.max(dragIndex,targetIndex);

                var droppedRow = tableRows.splice(dragIndex,1)[0];
                tableRows.splice(targetIndex, 0, droppedRow);

                var positions = [];

                tableRows.forEach( function(row,index) {
                    var id = row.querySelector("td").getAttribute("data-id");
                    var adPosition = index + 1;
                    positions.push({
                        id : id,
                        position : adPosition,
                    })
                });

                tableBody.innerHTML = "";
                tableRows.forEach(function(row){
                    tableBody.appendChild(row);
                })

                var formData = new FormData();
                formData.append('positions', JSON.stringify(positions));

                $.ajax({
                    url: '{{ route("drag&drop") }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers : {
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    },
                    success : function(response){
                        
                    },
                    error : function(error){

                    }

                })

            }
        }
    </script>
    <script src="{{asset('js/jquery-3.6.1.js')}}"></script>
</body>
</html>