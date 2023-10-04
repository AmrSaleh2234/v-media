function HandleProjectStatusBars(className) {
  const container = document.getElementsByClassName(className);
  console.log(container);
  for (let i = 0; i < container.length; i++) {
    const containerElement = container[i];
    let value = parseInt(containerElement.getAttribute("value"));
    const percentageElement =
      containerElement.getElementsByClassName("percentage")[0];
    const barElement = containerElement
      .getElementsByClassName("bar")[0]
      .getElementsByClassName("fill")[0];
    // Actions Goes Here
    barElement.style.transitionDelay = `${i * 400}ms`;
    percentageElement.innerText = value;
    barElement.style.width = `${value}%`;
    console.log(container[i], value);
    // Adding Colors To the bars by conditions
    if (value <= 30) {
      barElement.classList.add("yellow");
    } else if (value <= 70) {
      barElement.classList.add("blue");
    } else if (value > 70) {
      barElement.classList.add("green");
    }
  }
}

module.exports = HandleProjectStatusBars;
