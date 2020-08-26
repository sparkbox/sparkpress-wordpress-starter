const checkIE = () => {
  const isIE = /* @cc_on!@ */false || !!document.documentMode;

  if (isIE) {
    const html = document.getElementsByTagName('html')[0];
    html.className += ' ie11';
  }
};

checkIE();
