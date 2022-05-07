var data = {
  contacts: {},
  events: {},
};

var upper_space = document.getElementById("upper-space");
var colors = ["blue", "orange", "green", "red", "purple", "pink"];

var dom = {
  home: {
    container: document.getElementById("home"),
  },
  brochure: {
    container: document.getElementById("testimonials"),
  },
  event: {
    container: document.getElementById("event"),
    technical_event: document.getElementById("technical-event-content"),
    non_technical_event: document.getElementById("non-technical-event-content"),
  },
  workshop: {
    container: document.getElementById("workshop"),
    content: document.getElementById("workshop-content"),
  },
  expandModal: {
    container: document.getElementById("expand-modal"),
    content: document.getElementById("expand-modal-content"),
    title: document.getElementById("expand-modal-title"),
    register: document.getElementById("expand-modal-register"),
  },
  about: {
    container: document.getElementById("about"),
  },
  team: {
    container: document.getElementById("team"),
  },
  sponsors: {
    container: document.getElementById("sponsors"),
  },
  features: {
    container: document.getElementById("features"),
  },
  accommodation: {
    container: document.getElementById("accommodation"),
  },
};

dom.expandModal.switch = $(dom.expandModal.container);

window.addEventListener("load", async (e) => {
  data = await getRequiredData();
  setContacts();
  setEvents();
});

async function getRequiredData() {
  var v2 = await (await fetch("../../actions/get_events.php")).json();

  return {
    events: util.classify(v2, "event_type"),
  };
}

function setMainContent(tab) {
  dom.home.container.style.display = "none";
  dom.about.container.style.display = "none";
  dom.sponsors.container.style.display = "none";
  dom.event.container.style.display = "none";
  dom.workshop.container.style.display = "none";
  dom.team.container.style.display = "none";
  dom.features.container.style.display = "none";
  dom.accommodation.container.style.display = "none";
  dom.brochure.container.style.display = "none";
  upper_space.style.padding = "1rem";

  if (tab == "home") {
    upper_space.style.padding = "0rem";
    dom.features.container.style.display = "inherit";
    dom.home.container.style.display = "flex";
    dom.brochure.container.style.display = "inherit";
    // dom.sponsors.container.style.display = "inherit";
    dom.event.container.style.display = "inherit";
    dom.accommodation.container.style.display = "inherit";
    dom.workshop.container.style.display = "inherit";
    // dom.team.container.style.display = "inherit";
    dom.about.container.style.display = "inherit";
  } else if (tab == "about") {
    dom.about.container.style.display = "inherit";
  } else if (tab == "event") {
    dom.event.container.style.display = "inherit";
    dom.accommodation.container.style.display = "inherit";
  } else if (tab == "workshop") {
    dom.workshop.container.style.display = "inherit";
    dom.accommodation.container.style.display = "inherit";
  } else if (tab == "sponsors") {
    dom.sponsors.container.style.display = "inherit";
  } else if (tab == "team") {
    dom.team.container.style.display = "inherit";
  } else if (tab == "features") {
    dom.features.container.style.display = "inherit";
  }
  AOS.refreshHard();
  let x = document.getElementById("mobile-toggle");
  if (x && x.classList.contains("bi-x")) {
    x.click();
  }
}

// set the organizers and staffs
function setContacts() {}

// set the events and workshops
function setEvents() {
  // set tech
  // set non-tech
  // set carnival
  let str = "";
  let count = 0;
  data.events["event-non-technical"].forEach((e, i) => {
    if (count == colors.length) count = 0;
    str += `<div style="cursor: pointer;" class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
      <div class="service-box ${colors[count++]}">
        <i class="${e.icon_class} icon"></i>
        <h3>${e.name}</h3>
        <p>
          ${e.short}
        </p>
        <span style="cursor: pointer;" onclick="setEventModal('event-non-technical',${i})" href="#" class="read-more">
          <span>Register</span> <i class="bi bi-arrow-right"></i>
        </span>
      </div>
    </div>`;
  });
  dom.event.non_technical_event.innerHTML = str;

  str = "";
  count = 0;
  data.events["event-technical"].forEach((e, i) => {
    if (count == colors.length) count = 0;
    str += `<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
      <div class="service-box ${colors[count++]}">
        <i class="${e.icon_class} icon"></i>
        <h3>${e.name}</h3>
        <p>
          ${e.short}
        </p>
        <span style="cursor: pointer;" onclick="setEventModal('event-technical',${i})" href="#" class="read-more">
          <span>Register</span> <i class="bi bi-arrow-right"></i>
        </span>
      </div>
    </div>`;
  });

  dom.event.technical_event.innerHTML = str;

  str = "";
  count = 0;
  data.events["workshop"].forEach((e, i) => {
    if (count == colors.length) count = 0;
    str += `
    <div class="testimonial-item">
      <div class="profile mt-auto">
        <span class="testimonial-img"><i style="font-size: 36px;padding: 40px 20px;border-radius: 4px;position: relative;margin-bottom: 25px;display: inline-block;line-height: 0;transition: 0.3s;color:${
          colors[count++]
        }" class="${e.icon_class}" ></i></span>        
        <h3>${e.name}</h3>
      </div>
      <p>
      ${e.short}
    </p>
    <span style="cursor: pointer;" onclick="setEventModal('workshop',${i})" href="#" class="read-more">
          <span><b style="font-size:1.5 rem">Register</b></span> <i class="bi bi-arrow-right"></i>
        </span>
    </div>`;
  });

  dom.workshop.content.innerHTML = str;
}

//
function setEventModal(event_type, index) {
  dom.expandModal.register.className = "btn btn-flat btn-custom-blue";
  dom.expandModal.register.innerHTML = "Confirm";
  dom.expandModal.register.disabled = false;

  var e = data.events[event_type][index];
  dom.expandModal.title.innerHTML = `${e.name}`;
  // set data
  // open modal
  if (event_type != "event-technical") {
    dom.expandModal.content.innerHTML = `
              <div class="d-flex flex-row flex-wrap justify-content-center align-items-center">
                  <div class="card-header f-flex justify-content-center">
                      <img height="100%" width="100%" class="card-img-top" src="../../uploads/events/${e.image_path}" style="max-height: 300px;max-width: 400px;"/>
                  </div>
                  <div class="card-body">    
                      <div class="row">
                          <dd class="col-12">${e.description}</dd>
                          <dt class="col-sm-4">Amount </dt>
                          <dd class="col-sm-8">${e.amount} INR</dd>
                          <dt class="col-sm-4">Venue</dt>
                          <dd class="col-sm-8">${e.venue}</dd>
                          <dt class="col-sm-4">DateTime</dd>
                          <dd class="col-sm-8">${e.date_time}</dd>
                          <dt class="col-sm-4">Organizer</dd>
                          <dd class="col-sm-8">${e.organizer}</dd>
                        </div>
                  </div>
              </div>`;
  } else {
    dom.expandModal.content.innerHTML = `
              <div class="d-flex flex-row flex-wrap justify-content-center align-items-center">
                  <div class="card-header f-flex justify-content-center">
                      <img height="100%" width="100%" class="card-img-top" src="../../uploads/events/${e.image_path}" style="max-height: 300px;max-width: 400px;"/>
                  </div>
                  <div class="card-body">    
                      <div class="row">
                          <dd class="col-12">${e.description}</dd>
                          <dt class="col-sm-4">Venue</dt>
                          <dd class="col-sm-8">${e.venue}</dd>
                          <dt class="col-sm-4">DateTime</dd>
                          <dd class="col-sm-8">${e.date_time}</dd>
                          <dt class="col-sm-4">Organizer</dd>
                          <dd class="col-sm-8">${e.organizer}</dd>
                      </div>
                  </div>
              </div>`;
  }
  dom.expandModal.switch.modal("show");
  dom.expandModal.register.onclick = () => register(e.event_id);
}

// logic for register the event (redirect to sign in)
function register(event_id) {
  window.location.href = "../../pages/sign_in.php";
}

//  util operations
const util = {
  classify(objArr, by) {
    let out = {};
    for (let i of objArr) (out[i[by]] || (out[i[by]] = [])).push(i);
    return out;
  },
  isEqual(a, b) {
    if (Object.keys(a).length !== Object.keys(b).length) return false;
    for (let i in a) if (a[i] != b[i]) return false;
    return true;
  },
};

setMainContent("home");
