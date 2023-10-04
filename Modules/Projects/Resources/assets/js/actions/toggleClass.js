function HandleProjectStatusBars(element, className) {
  const condition = element.classList.contains(className);
  if (condition) {
    element.classList.remove(className);
  } else {
    element.classList.add(className);
  }
}
module.exports = HandleProjectStatusBars;
