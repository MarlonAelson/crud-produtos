@forelse ($objetos as $objeto)
    <tr>
        <td>
            {{$objeto->id}}
        </td>
        <td>
            {{$objeto->nome_alternativo}}
        </td>
        <td>
            {{$objeto->ativo}}
        </td>
        <td>
            <a href="{{ route($informacoesComunsViews['route_name_view'].'.edit', $objeto->id) }}" class="btn btn-outline-primary"><i class="fas fa-list-ol"></i> Editar</a>
        </td>
    </tr>
@empty
    Nenhuma categoria cadastrada
@endforelse


