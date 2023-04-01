// bot.test.js
const { Bot } = require('./chatbot.js');
const { fireEvent, getByText } = require('@testing-library/dom');

describe('Bot', () => {
    test('sleep', async () => {
        const startTime = Date.now();
        await Bot.sleep(500);
        const endTime = Date.now();
        const elapsedTime = endTime - startTime;
        expect(elapsedTime).toBeGreaterThanOrEqual(500);
    });

    test('scrollContainer', () => {
        document.body.innerHTML = `
      <div id="chatbot-inner" style="height: 100px; overflow: auto;">
        <div style="height: 200px;"></div>
      </div>
    `;
        const inner = document.getElementById('chatbot-inner');
        Bot.scrollContainer();
        expect(inner.scrollTop).toBe(inner.scrollHeight - inner.clientHeight);
    });

    test('insertNewChatItem', () => {
        document.body.innerHTML = `
      <div id="chatbot">
      </div>
    `;
        const peekobot = document.getElementById('chatbot');
        const testElement = document.createElement('div');
        testElement.classList.add('test-element');
        Bot.insertNewChatItem(testElement);

        expect(peekobot.children.length).toBe(1);
        expect(peekobot.children[0]).toBe(testElement);
        expect(testElement.classList.contains('activated')).toBeTruthy();
    });

    test('disableAllChoices', () => {
        document.body.innerHTML = `
      <div class="choice"></div>
      <div class="choice"></div>
      <div class="choice"></div>
    `;
        const choices = document.querySelectorAll('.choice');
        Bot.disableAllChoices();
        choices.forEach((choice) => {
            expect(choice.disabled).toBeTruthy();
        });
    });

    test('handleRestart', () => {
        const startConversationMock = jest.spyOn(Bot, 'startConversation');
        Bot.handleRestart();
        expect(startConversationMock).toHaveBeenCalledTimes(1);
    });

    test('handleChoice with button', () => {
        document.body.innerHTML = `
      <div id="chatbot-container">
        <button class="choice" data-next="2"></button>
      </div>
    `;
        const chat = {
            2: {
                text: 'Test response',
                options: [
                    { text: 'Option 1', next: 3 },
                    { text: 'Option 2', next: 4 },
                ],
            },
        };
        const choiceButton = document.querySelector('.choice');
        fireEvent.click(choiceButton);

        setTimeout(() => {
            const responseElem = document.querySelector('.chat-response');
            expect(responseElem.textContent).toBe('Test response');

            const optionButtons = document.querySelectorAll('.choice');
            expect(optionButtons.length).toBe(2);
            expect(getByText(document.body, 'Option 1')).toBeInTheDocument();
            expect(getByText(document.body, 'Option 2')).toBeInTheDocument();
        }, 2000);
    });
});