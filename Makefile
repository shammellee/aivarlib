SHELL := /bin/bash
.PHONY: all clean

CLEAN_FILES = aivarlib

all: aivarlib

aivarlib: aivarlib.cpp
	g++ -I $${BOOST_ROOT}include/ -L$${BOOST_ROOT}/lib/ -L$${BOOST_ROOT}lib/ -lboost_program_options $< -o $@

clean:
	rm -f $(CLEAN_FILES)