
const modal = document.getElementById('commentmodal');
const openBtn = document.getElementById('modalbcomentario');
const cancelBtn = document.getElementById('botoncancelar');
const submitBtn = document.getElementById('botonenviar');
const commentText = document.getElementById('commentText');

openBtn.onclick = () => {
  modal.style.display = 'flex';
  commentText.value = '';
};

cancelBtn.onclick = () => {
  modal.style.display = 'none';
};

submitBtn.onclick = () => {
  const comentario = commentText.value.trim();
  if (comentario) {
    alert('Comentario enviado: ' + comentario);
    modal.style.display = 'none';
  } else {
    alert('Por favor escribe un comentario.');
  }
};

window.onclick = (e) => {
  if (e.target === modal) {
    modal.style.display = 'none';
  }
};



// Abrir y cerrar modal de calificación
const calificacionModal = document.getElementById('calificacionmodal');
const abrirModalCalificacion = document.getElementById('modalcalificacion');
const cancelarCalificacion = document.getElementById('cancelarcalificacion');

abrirModalCalificacion.onclick = () => {
  calificacionModal.style.display = 'flex';
};

cancelarCalificacion.onclick = () => {
  calificacionModal.style.display = 'none';
};

window.onclick = (e) => {
  if (e.target === calificacionModal) {
    calificacionModal.style.display = 'none';
  }
};
