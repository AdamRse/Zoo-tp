async function getFetch(script, rq = false) {
    rq = rq ? "?"+rq : "";
    const reponse = await fetch("./ajax/"+script+".php"+rq);
    const rt = await reponse.json();
    return rt;
  }
  