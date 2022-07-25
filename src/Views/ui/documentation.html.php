<div class="content-documentation">   
    <h1>GUIA</h1>
    <p>A continuacion se presenta la documentacion de la API 
    </p>
    <p>
        Todos los datos se representan como archivos json por ejmplo:
        <blockquote class="consola json">
            <pre>
                {
                   "agentes" : [
                        {
                            "id": "12340",
                            "nombre": "Juan Barragan",
                        } ...
                    ]
                }
            </pre>
        </blockquote> 
    </p>
    <article>
        <h2>Obtener los datos de los Agentes Municipales</h2>
        <section>
            <h3 class="title3">Recurso</h3>
            <blockquote class="consola url">
                <span>
                https://<?=$_ENV['SERVER_DIRECCION'];?>/api/agentes-municipales
                </span>
            </blockquote>
            <h3 class="title3">Resultado</h3>
            <blockquote class="consola json">
                <pre>
                    {
                        
                        "id": "...",
                        "nombre": "...",
                        "clave": "...(encriptada)"
                        "permisos": "..."
                    }
                </pre>
            </blockquote>
        </section>
    </article>      
    <article>
        <h2>Obtener los datos de los locales comercials</h2>
        <section>
            <h3 class="title3">Recurso</h3>
            <blockquote class="consola url">
                <span>
                https://<?= $_ENV['SERVER_DIRECCION'] ?>/api/locales-comerciales
                </span>
            </blockquote>
            <h3 class="title3">Resultado</h3>
            <blockquote class="consola json">
                <pre>
                {"locales":[
                        {
                            "id": "...",
                            "nombre": "...",
                            "tipo": "...",
                            "sector": "...",
                            "ruc": "...",
                            "imagen": "...(codificada en BASE 64)",
                            "id_locacion": "...",
                            "id_propietario": "...",
                            "id_usuario": "..."
                        },
                        ...
                    ]
                }
                </pre>
            </blockquote>
        </section>
    </article>
    <article>
        <h2>Obtener los datos de un local comercial</h2>
        <section>
            <h3 class="title3">Recurso</h3>
            <blockquote class="consola url">
                <span>
                https://<?= $_ENV['SERVER_DIRECCION'] ?>/api/locales-comerciales?id=valor
                </span>
            </blockquote>
            <h3 class="title3">Resultado</h3>
            <blockquote class="consola json">
                <pre>
                    {
                        "id": "...",
                        "nombre": "...",
                        "tipo": "...",
                        "sector": "...",
                        "ruc": "...",
                        "imagen": "... (codificada en BASE 64)",
                        "id_locacion": "...",
                        "id_propietario": "...",
                        "id_usuario": "..."
                    }
                </pre>
            </blockquote>
        </section>
    </article>  
    <article>
        <h2>Insertar los datos de un loca comercial por medio del metodo POST</h2>
        <section>
            <h3 class="title3">Recurso</h3>
            <blockquote class="consola url">
                <span>
                https://<?= $_ENV['SERVER_DIRECCION'] ?>/api/locales-comerciales
                </span>
            </blockquote>
            <blockquote class="info">
                <p>
                    Se debe enviar por medio de solicitud POST los siguientes arguentos
                    <ul>
                        <li>
                            <span class="clave">id</span> = <span class="valor">(string)</span>
                        </li>
                        <li>
                            <span class="clave">nombre</span> = <span class="valor">(string)</span>
                        </li>
                        <li>
                            <span class="clave">tipo</span> = <span class="valor">(string)</span>
                        </li>
                        <li>
                            <span class="clave">sector</span> = <span class="valor">(string)</span>
                        </li>
                        <li>
                            <span class="clave">ruc</span> = <span class="valor">(string)</span> ➡ Opcional
                        </li>
                        <li>
                            <span class="clave">imagen</span> = <span class="valor">(string (codificada en BASE 64))</span>
                        </li>
                        <li>
                            <span class="clave">id_locacion</span> = <span class="valor">(int)</span>
                        </li>
                        <li>
                            <span class="clave">id_propietario</span> = <span class="valor">(int)</span>
                        </li>
                        <li>
                            <span class="clave">id_usuario</span> = <span class="valor">(string)</span>
                        </li>
                    </ul>
                </p>
            </blockquote>
            <h3 class="title3">Resultado</h3>
            <blockquote class="consola json">
                    <pre>
                        {"res":"Se inserto correctamente el local comercial","ident": 1,"error":""} 
                        || 
                        {"res":"Error no se inserto el local comercial","ident": 0,"error": "El error que muestra la base de datos"}
                    </pre>
            </blockquote>
        </section>
    </article> 
    <article>
        <h2>Obtener la informacion de las locaciones</h2>
        <section>
            <h3 class="title3">Recurso</h3>
            <blockquote class="consola url">
                <span>
                https://<?= $_ENV['SERVER_DIRECCION'] ?>/api/locaciones
                </span>
            </blockquote>
            <h3 class="title3">Resultado</h3>
            <blockquote class="consola json">
                <pre>
                {"locaciones":[
                        {
                            "id": "...",
                            "link": "..."
                        },
                        ...
                    ]
                }
                </pre>
            </blockquote>
        </section>
    </article>    
    <article>
        <h2>Obtener los datos de un sector</h2>
        <section>
            <h3 class="title3">Recurso</h3>
            <blockquote class="consola url">
                <span>
                https://<?= $_ENV['SERVER_DIRECCION'] ?>/api/locaciones?id=valor
                </span>
            </blockquote>
            <h3 class="title3">Resultado</h3>
            <blockquote class="consola json">
                <pre>
                    {
                        "id": "...",
                        "link": "..."
                    }
                </pre>
            </blockquote>
        </section>
        <article>
        <h2>Insertar los datos de un sector por medio del metodo POST</h2>
        <section>
            <h3 class="title3">Recurso</h3>
            <blockquote class="consola url">
                <span>
                https://<?= $_ENV['SERVER_DIRECCION'] ?>/api/locaciones
                </span>
            </blockquote>
            <blockquote class="info">
                <p>
                    Se debe enviar por medio de solicitud POST los siguientes arguentos
                    <ul>
                        <li>
                            <span class="clave">link</span> = <span class="valor">(string)</span>
                        </li>
                    </ul>
                </p>
            </blockquote>
            <h3 class="title3">Resultado</h3>
            <blockquote class="consola json">
                    <pre>
                        {"res":"Se inserto correctamente el sector","ident": 1,"error":""} 
                        || 
                        {"res":"Error no se inserto correctamente el sector","ident": 0,"error": "El error que muestra la base de datos"}
                    </pre>
            </blockquote>
        </section>
    </article>  
    <br>
    <p> Esto constituye todo lo puede realizar el sistema con la API Comercios</p>
    <br>
    <br>
</div>