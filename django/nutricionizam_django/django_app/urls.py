from django.urls import path
from .views import API_RES_Views

urlpatterns = [
    path('upit', API_RES_Views, name='API_RES_Views')
]
