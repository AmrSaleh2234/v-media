const toggleClass = require("./toggleClass");

function ExpandChatMessage(className) {
  const chatSection = document.getElementById("chatSection");
  const allMessageCards = chatSection.getElementsByClassName("message-row");

  if (allMessageCards && allMessageCards.length) {
    for (let i = 0; i < allMessageCards.length; i++) {
      const messageCard = allMessageCards[i];
      const messageCardContnent = messageCard.getElementsByClassName("name")[0];
      messageCardContnent.addEventListener("click", () => {
        toggleClass(messageCard, "expanded");
      });
    }
  }
}

module.exports = ExpandChatMessage;
