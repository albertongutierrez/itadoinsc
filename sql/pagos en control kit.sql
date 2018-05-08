Select 
a.codinscripcion, 
a.inscrito_en,
a.codempresa,
a.estado_inscripcion,
a.fecha_inscripcion, 
a.nombre, 
a.apellido, 
a.telefono, 
a.email, 
a.cedula, 
a.genero, 
b.descripcion as pais, 
c.descripcion as provincia, 
c.codprovincia as codprovincia,
d.codgrupo as codgrupo,
d.descripcion as grupo, 
a.otro_grupo, 
h.pago_participante, 
h.pago_acom_mayor, 
h.pago_acomp_menor,
h.pagado as pago,
h.pend_participante, 
h.pend_acom_mayor, 
h.pend_acomp_menor, 
a.contacto_emergencia, 
a.telefono_emergencia, 
a.comentario, 
a.acuerdo_termino, 
a.revisado,
a.entregado, 
g.mostrar,
e.codactividad as actividad
From
inscripcion a, pais b, provincias_pais c, grupos_pais d, actividades e, nacionalidad f, inscrito_en g,
vcontrol_pagos h
where 
b.codpais= a.codpais  
and b.estado='A'
and c.codprovincia= a.codprovincia 
and c.estado='A'
and d.codgrupo=a.codgrupo 
and d.estado='A' 
and d.codempresa= a.codempresa
and e.codactividad=a.codactividad 
and e.estado='A' 
and e.codempresa= a.codempresa
and f.codnacionalidad=a.codnacionalidad 
AND f.codempresa = a.codempresa
and f.estado='A' 
and g.codempresa=a.codempresa
and g.codinscritoen=a.inscrito_en
and g.mostrar='S'
and h.codinscripcion=a.codinscripcion
and h.inscrito_en=a.inscrito_en
and h.codempresa=a.codempresa
and h.codactividad=a.codactividad
and a.estado_inscripcion<>'B'
and concat(a.codinscripcion,' ',a.inscrito_en) not in (Select concat(codinscripcion,' ',inscrito_en) from `control_kit` )