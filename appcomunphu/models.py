# models.py
from django.contrib.auth.models import AbstractUser
from django.db import models

class UsuarioCustomizado(AbstractUser):
    matricula = models.CharField(max_length=50, unique=True)
    nombre_completo = models.CharField(max_length=100)
    correo_institucional = models.EmailField(unique=True)

    def __str__(self):
        return self.username
