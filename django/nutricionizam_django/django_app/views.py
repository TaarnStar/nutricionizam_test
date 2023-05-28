from rest_framework.response import Response
from rest_framework.decorators import api_view
from urllib.parse import unquote


@api_view(['POST'])
def API_RES_Views(request):
    query_string = request.META.get('QUERY_STRING', '')
    var = unquote(query_string.split('=')[1]) if '=' in query_string else ''
    var2 = request.data.get('value')

    if len(var) == 0:
        response_data = request.data
    elif var.startswith('{') and var.endswith('}'):
        response_data = {var[1:-1]: var2}
    else:
        response_data = {var: var2} if var else {}

    if not response_data:
        response_data = request.data

    return Response(response_data)
