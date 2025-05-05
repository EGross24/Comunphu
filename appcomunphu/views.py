from django.shortcuts import render

# Create your views here.
from django.http import HttpResponse 
def Usuarios(request): 
    return HttpResponse("Nuestra primera vista!")